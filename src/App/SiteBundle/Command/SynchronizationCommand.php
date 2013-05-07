<?php
namespace App\SiteBundle\Command;

use App\SiteBundle\Entity\Set;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SynchronizationCommand extends ContainerAwareCommand
{
    public function preloadRarities()
    {
        $repository = $this->getContainer()->get('doctrine')->getRepository('AppSiteBundle:Rarity');
        $rarities = $repository->findAll();

        foreach($rarities as $rarity) {
            $key = strtoupper($rarity->getCode());
            $this->rarities[$key] = $rarity;
        }
    }

    protected function configure()
    {
        $this
            ->setName('app:synchronization')
            ->setDescription('Synchronizes our magic database with gatherer information')
        ;
    }

    /**
     * Werkwijze:
     * 1. Set ophalen welke moet worden gesynchronizeerd.
     * 2. Ophalen van de kaarten uit gatherer.
     * 3. Per kaart deze ophalen uit de database, en nakijken.
     * 3.1 Bestaat deze? Ja - aanpassen, Nee - toevoegen.
     * 4. Set markeren als gesynchornizeerd.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->preloadRarities();

        $path = realpath(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
        $file = $path.'/data/';

        $doctrine = $this->getContainer()->get('doctrine');
        $setRepository = $doctrine->getRepository('AppSiteBundle:Set');
        $cardRepository = $doctrine->getRepository('AppSiteBundle:Card');
        $cardVersionRepository = $doctrine->getRepository('AppSiteBundle:CardVersion');

        $set = $setRepository->findOneNotSynchronized();

        $xml = simplexml_load_file($file.strtoupper($set->getCode()).'.xml');

        $result = $xml->xpath('cards/card');

        foreach($result as $card)
        {
            // Load or save basic card info as name / slug.
            $storedCard = $cardRepository->findOneByName( $card->name );
            if (null === $storedCard) {
                $storedCard = new \App\SiteBundle\Entity\Card();
                $storedCard->setName($card->name);
                $storedCard->setSlug($this->slugify($card->name));
                $doctrine->getManager()->persist($storedCard);
                $doctrine->getManager()->flush();
            }

            $cardVersion = $cardVersionRepository->findOneById($card->id);

            if (null === $cardVersion) {
                $cardVersion = new \App\SiteBundle\Entity\CardVersion();
                $cardVersion->setId( (int) $card->id);
                $cardVersion->setCard($storedCard);
                $cardVersion->setSet($set);

                $doctrine->getManager()->persist($cardVersion);
                $doctrine->getManager()->flush();
            }

            $toughness = (string) $card->toughness;
            $toughness = mb_strlen($toughness) < 1 ? null : $toughness;
            $loyalty = (string) $card->loyalty;
            $loyalty = mb_strlen($loyalty) < 1 ? null : $loyalty;
            $power = (string) $card->power;
            $power = mb_strlen($power) < 1 ? null : $power;
            $flavor = (string) $card->flavor;
            $flavor = mb_strlen($flavor) < 1 ? null : $flavor;
            $text = (string) $card->ability;
            $text = mb_strlen($text) < 1 ? null : $text;
            $arist = $this->getArtistByName($card->artist);
            $rarity = $this->getRarityByCode($card->rarity);

            $cardVersionPart = new \App\SiteBundle\Entity\CardVersionPart();
            $cardVersionPart->setVersion($cardVersion);
            $cardVersionPart->setName($card->name);
            $cardVersionPart->setArtist($arist);
            $cardVersionPart->setRarity($rarity);
            $cardVersionPart->setText($text);
            $cardVersionPart->setFlavor($flavor);
            $cardVersionPart->setPower($power);
            $cardVersionPart->setToughness($toughness);
            $cardVersionPart->setLoyalty($loyalty);
            $cardVersionPart->setTypes($card->type);
            $cardVersionPart->setManaCost($card->manacost);
            $cardVersionPart->setNumber($card->number);
            $cardVersionPart->setConvertedManaCost($card->converted_manacost);

            $image = sprintf($path.'/data/%s/%d.full.jpg', $set->getName(), $cardVersion->getId());
            $imageTarget = sprintf($path.'/web/images/sets/%s/%d-%d.jpg', $set->getCode(), $cardVersion->getId(), 1);

            copy($image, $imageTarget);
            $cardVersionPart->setImage(sprintf('%d-%d.jpg', $cardVersion->getId(), 1));

           $doctrine->getManager()->persist($cardVersionPart);
           $doctrine->getManager()->flush();
        }
    }

    public function getArtistByName($artistName)
    {
        $artistName = trim($artistName);
        $artistRepository = $this->getContainer()->get('doctrine')->getRepository('AppSiteBundle:Artist');
        $artist = $artistRepository->findOneByName($artistName);

        if (null === $artist) {
            $artist = new \App\SiteBundle\Entity\Artist();
            $artist->setName($artistName);

            $this->getContainer()->get('doctrine')->getManager()->persist($artist);
            $this->getContainer()->get('doctrine')->getManager()->flush();
        }

        return $artist;
    }

    public function getRarityByCode($code)
    {
        $parts = explode("//", (string) $code);
        return $this->rarities[ trim($parts[0]) ];
    }

    public function slugify($string)
    {
        if (function_exists('iconv')) {
            $string = @iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        }
        $string = preg_replace("/[^a-zA-Z0-9 -]/", "", $string);
        $string = strtolower($string);
        $string = str_replace(" ", '-', $string);
        return $string;
    }
}
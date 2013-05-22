<?php
namespace App\SiteBundle\Command;

use App\SiteBundle\Entity\Set;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSetsCommand extends ContainerAwareCommand
{


    protected function configure()
    {
        $this
            ->setName('app:import-sets')
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

        $path = realpath(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
        $directory = $path.'/data/';

        $directoryIterator = new \DirectoryIterator($directory);

        foreach($directoryIterator as $file) {


            if ($file->isDot()) continue;
            if ($file->isDir()) continue;

            $xml = simplexml_load_file($file->getPathname());
            $result = $xml->xpath('sets/set');

            $set = $result[0];

            $model = new Set();
            $model->setCode( strtolower((string) $set->code));
            $model->setName((string) $set->name);
            $model->setSlug($this->slugify((string) $set->name));

            $dateparts = explode("/", (string)$set->date);
            $isPromo = $set->is_promo === 'False' ? false : true;

            $model->setReleaseDate(new \DateTime($dateparts[1].'-'.$dateparts[0].'-01'));
            $model->setPromo($isPromo);

            $cards = $xml->xpath('cards/card');

            $model->setCardCount(sizeof($cards));

            $this->getContainer()->get('doctrine')->getManager()->persist($model);
        }
        $this->getContainer()->get('doctrine')->getManager()->flush();

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
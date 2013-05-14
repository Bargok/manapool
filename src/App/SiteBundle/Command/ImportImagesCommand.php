<?php
namespace App\SiteBundle\Command;

use App\SiteBundle\Entity\Set;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportImagesCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:import-images')
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
        $path = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

        $dataPath = realpath(dirname($path)).'/data/';
        $targetPath = realpath($path).'/web/images/';

        $iterator = new \DirectoryIterator($dataPath);

        foreach($iterator as $file) {
            if ($file->isDot() || $file->isDir()) continue;

            $xml = simplexml_load_file($dataPath.$file->getFilename());

            $set = $xml->xpath('sets/set');
            $set = $set[0];

            if (!file_exists(sprintf('%s%s', $targetPath, strtolower($set->code)))) {
                mkdir(sprintf('%s%s', $targetPath, strtolower($set->code)));
            }

            $result = $xml->xpath('cards/card');

            foreach($result as $card) {

                $source = sprintf('%s%s/%s.full.jpg', $dataPath, str_replace(array(":", "\"", "/"), "", (string) $set->name), (string) $card->id);
                $target = sprintf('%s%s/%s-1.jpg', $targetPath, strtolower((string) $set->code), (string) $card->id);

                copy($source, $target);
            }

            exit;
        }
    }
}
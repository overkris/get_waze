<?php
/**
 * Created by PhpStorm.
 * User: cbeuffre
 * Date: 21/09/2017
 * Time: 13:32
 */
namespace Command;

use Entity\EventLoad;
use Entity\LoadWaze;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Unirest\Request;

class ImportWaze extends Command
{
    const URL_WAZE = "http://www.waze.com/row-rtserver/web/TGeoRSS";

    /**
     * Configure de la commande
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('importwaze')
            ->setDescription('Import des ligne Waze');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Set du temps
        $iStartTime = microtime(true);

        // Set de la bdd
        $entityManager = $this->getApplication()->entityManager;

        // Création du nouveau Event
        $newEventLoad = new EventLoad();
        $newEventLoad->setDatetimeevent(new \DateTime("now"));
        $newEventLoad->setTimeLoad(0);
        $entityManager->persist($newEventLoad);

        // Get du fichier de config
        $locator = new FileLocator(array(APP_ROOT.'/config'));
        $aobjListeSegment = simplexml_load_file($locator->locate("segment_waze.xml", null));

        $aListeEvent = array();
        foreach ($aobjListeSegment as $idKey => $segment) {
            // COnstruction de la query
            $query = array(
                "id" => $segment->id,
                "mj" => $segment->mj,
                "mu" => $segment->mu,
                "left" => $segment->left,
                "right" => $segment->right,
                "bottom" => $segment->bottom,
                "top" => $segment->top
            );

            $response = Request::post(self::URL_WAZE, array('Accept' => 'application/json'), $query);

            if ($response->code == 200 && isset($response->body->alerts)) {
                foreach ($response->body->alerts as $aValue) {
                    // On affiche que la police
                    if ($aValue->type == "POLICE") {
                        if (!isset($aListeEvent[$aValue->id])) {
                            $aListeEvent[$aValue->id] = array(
                                "x" => $aValue->location->x,
                                "y" => $aValue->location->y,
                                "nbUp" => $aValue->nThumbsUp
                            );
                        }
                    }
                }
            }
        }

        // Insert en base des événements
        foreach ($aListeEvent as $aEvent) {
            // Ajout du retour de l'api avec l'event
            $newLoadWaze = new LoadWaze();
            $newLoadWaze->setIdLoad($newEventLoad);
            $newLoadWaze->setTypeEvent("POLICE");
            $newLoadWaze->setCoorX($aEvent["x"]);
            $newLoadWaze->setCoorY($aEvent["y"]);
            $newLoadWaze->setNbUp($aEvent["nbUp"]);
            $entityManager->persist($newLoadWaze);
        }

        $newEventLoad->setTimeLoad(microtime(true) - $iStartTime);
        $entityManager->flush();
    }
}
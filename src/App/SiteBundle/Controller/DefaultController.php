<?php

namespace App\SiteBundle\Controller;

use App\SiteBundle\Entity\Block;
use App\SiteBundle\Entity\Set;
use App\SiteBundle\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppSiteBundle:Default:index.html.twig');
    }

    public function searchAction()
    {
        $term = $this->getRequest()->get('q');

        $repository = $this->getDoctrine()->getRepository('AppSiteBundle:CardVersionPart');
        $results = $repository->findBySearchTerm($term);


        return $this->render('AppSiteBundle:Default:search.html.twig', array('results' => $results));
    }
}

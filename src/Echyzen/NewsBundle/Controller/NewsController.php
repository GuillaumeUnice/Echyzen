<?php

namespace Echyzen\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction($page)
    {
    	$em = $this->getDoctrine()->getManager();
    	$repository = $em->getRepository('EchyzenNewsBundle:News');

    	$new = $repository->find(1);
        return $this->render('EchyzenNewsBundle:News:index.html.twig', 
        	array('page' => $page,
        	'new' => $new
        	));
    }

    public function redigerAction($page)
    {

        return $this->render('EchyzenNewsBundle:News:index.html.twig', array('page' => $page));
    }

}
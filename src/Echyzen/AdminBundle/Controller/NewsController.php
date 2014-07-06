<?php

namespace Echyzen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Echyzen\NewsBundle\Entity\News;

class NewsController extends Controller
{
    public function indexAction() {
        return $this->render('EchyzenAdminBundle:News:index.html.twig');
    }
    public function listeAction()
    {
         $em = $this->getDoctrine()->getManager();

        // recupération de l'ensemble des rubriques
        $entities = $em->getRepository('EchyzenNewsBundle:News')->findAll();

        return $this->render('EchyzenAdminBundle:news:liste.html.twig', array(
            'entities' => $entities,
        ));
    }
}

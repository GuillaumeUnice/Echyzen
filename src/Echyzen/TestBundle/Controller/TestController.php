<?php

namespace Echyzen\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    private $pathEntity = 'Echyzen\TestBundle\Entity\\';
    /**
    * Page d'index des test : Affiche l'ensemble des test 
    * A faire : par ordre de date de création
    *
    */
    public function indexAction($type, $genre_id)
    {
        $entityName = ucfirst($type);
        $em = $this->getDoctrine()->getManager();
        $arrray =  array();


       /* $array['count'] = $em->getRepository('EchyzenTestBundle:Test')->getCountType(); 
        die(print_r($array['count']));*/




        if($genre_id) {
            $delim = $this->container->getParameter('echyzen_test.index_genre_delimiter');
            $genreId = array_filter(explode($delim, $genre_id));
            
            $pathEntity = ($type != 'test')?$this->pathEntity . $entityName:null;
            
            $array['entities'] = $em->getRepository('EchyzenTestBundle:Test')
            ->getByGenre($pathEntity, $genreId);    

        } else {

             // obtenir toutes les test du plus récent au plus vieux
            $array['entities'] = $em->getRepository('EchyzenTestBundle:'  . $entityName)
            ->findBy(array(), array('date' => 'desc'));     
        }
        return self::vue($array);
    } // indexAction ()

    /**
    *   Permet de renvoyer une vue en fonction d'une requete Ajax
    *   A faire : Eventuellement rajouter un parametre boolean qui permet de dire si l'on envoie en
    *   JSON ou HTML
    *   @param $array tableau contenant les variables a envoyer 
    *       notamment $array[entities] contenant les tests a charger
    */
    private function vue($array) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()){ // si requete ajax alors envoie juste les test
            
            $res = array();
            $res['html'] = $this->renderView('EchyzenTestBundle:Test:index_show.html.twig', $array);

            $response = new Response();

            $response->setContent($res['html']);
            
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/html');

            return $response;

        } else { // renvoie une page contenant toutes les informations
            return $this->render('EchyzenTestBundle:Test:index.html.twig', $array);
        }
	}

    /**
    * Affiche le test en particulier
    *
    */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $arrray =  array();
        $request = $this->getRequest();

        // trouver le test en question
        $array['entity'] = $em->getRepository('EchyzenTestBundle:Test')->find($id);
        if (!$array['entity']) {
            // Pour le moment une exception mais par la suite une redirection ;)
            throw $this->createNotFoundException('Unable to find Test entity.');
        }
        if ($request->isXmlHttpRequest()){ // si requete ajax alors envoie juste le display du test
            
            $res = array();
            $res['html'] = $this->renderView('EchyzenTestBundle:Test:show_ajax.html.twig', $array);

            $response = new Response();

            $response->setContent($res['html']);
            
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/html');

            return $response;

        } else { // renvoie une page contenant toutes les informations
            return $this->renderView('EchyzenTestBundle:Test:show_ajax.html.twig', $array);
        }
        //return $this->render('EchyzenTestBundle:Test:show.html.twig', $array);
    } // indexAction ()
}
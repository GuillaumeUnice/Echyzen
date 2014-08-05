<?php

namespace Echyzen\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    /**
    * Page d'index des test : Affiche l'ensemble des test 
    * A faire : par ordre de date de création
    *
    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $arrray =  array();

        // obtenir toutes les test du plus récent au plus vieux
        $array['entities'] = $em->getRepository('EchyzenTestBundle:Test')
            ->findBy(array(), array('date' => 'desc'));

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

        // obtenir toutes les test du plus récent au plus vieux
        $array['entity'] = $em->getRepository('EchyzenTestBundle:Test')->find($id);

        return $this->render('EchyzenTestBundle:Test:show.html.twig', $array);
    } // indexAction ()
}
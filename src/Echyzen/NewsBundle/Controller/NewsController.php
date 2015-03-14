<?php

namespace Echyzen\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Echyzen\NewsBundle\Entity\News;
use Echyzen\NewsBundle\Form\NewsType;

use Echyzen\NewsBundle\Entity\Image;
use Echyzen\NewsBundle\Form\ImageType;

use Echyzen\NewsBundle\Entity\Commentaire;
use Echyzen\NewsBundle\Form\CommentaireType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
/**
 * News controller.
 *
 */
class NewsController extends Controller
{

    /**
    * Page d'index des news : Affiche l'ensemble des news 
    *
    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $arrray =  array();

        // obtenir toutes les news du plus récent au plus vieux
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')
            ->findBy(array(), array('date' => 'desc'));

        return self::vue($array);
    } // indexAction ()

    /**
     * Finds and displays a News entity.
     *
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $array = array();
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')
            ->findBy(array('id' => $id));

        if (!$array['entities']) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        return self::vue($array);
    }


    public function getByMonthAction($year, $month) {
        $em = $this->getDoctrine()->getManager();
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')->getByMonth($year, $month);

        // si le résultat est vide on retourne l'index
        if($array['entities'] === null) {
            return self::indexAction();
        }

        return self::vue($array);
    }
    public function getByRubriqueAction ($id)
    {
        $em = $this->getDoctrine()->getManager();
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')->getByRubrique($id);
        // si le résultat est vide on retourne l'index
        if($array['entities'] === null) {
            return self::indexAction();
        }
        return self::vue($array);     
    }

    public function getByMotCleAction ($id)
    {
        $em = $this->getDoctrine()->getManager();
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')->getByMotCle($id);
        // si le résultat est vide on retourne l'index
        if($array['entities'] === null) {
            return self::indexAction();
        }
        return self::vue($array);     
    }

    /**
    *   Fonction permettant de créer formulaire/entité et persister un commentaire lié a une news
    *   @param $id nombre représentant l'id de la news associé a ce commentaire
    *   TODO : vérifier le retour plutot faire la méthode comme dans self::vue qui diffère
    *   selon la requete de type ajax ou non
    *
    */
    public function createCommentaireAction($id) {

        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('EchyzenNewsBundle:News')->find($id);

        if(!$news) {

            $this->get('session')->getFlashBag()->add(
                'erreur',
                'Page inexistante, la news n\'a pas pu être trouvé 
                il est donc impossible de poster un commentaire'
            );
            // Pour le moment une exception mais par la suite une redirection ;)
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $commentaire = new Commentaire($news);
        $form = $this->createForm(new CommentaireType, $commentaire);

        //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();
        if($request->getMethod() == 'POST') {

            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            // vérification de la validité

            if($form->isValid()) {

                //ajout du commentaire à la news
                $news->addCommentaire($commentaire);


                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                $em->persist($commentaire);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Le commentaire a été prit enregistré'
                );
            }
        }

        return $this->render('EchyzenNewsBundle:commentaire:create.html.twig', array(
            'form'   => $form->createView(),
        ));
    } // createCommentaireAction()

    /**
    *   Permet de renvoyer une vue en fonction d'une requete Ajax
    *   A faire : Eventuellement rajouter un parametre boolean qui permet de dire si l'on envoie en
    *   JSON ou HTML
    *   @param $array tableau contenant les variables a envoyer 
    *       notamment $array[entities] contenant les news a charger
    */
    private function vue($array) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()){ // si requete ajax alors envoie juste les news
            $res = array();
            $res['html'] = $this->renderView('EchyzenNewsBundle:News:index_show.html.twig', $array);

            $response = new Response();
            $response->setContent($res['html']);
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/html');        
            return $response;

        } else { // renvoie une page contenant toutes les informations
            
            $array['dates'] = self::getCountByMonth();
            $array['motCles'] = $em->getRepository('EchyzenNewsBundle:News')->getCountByMotCle();
            $array['rubriques'] = $em->getRepository('EchyzenNewsBundle:Rubrique')->getRubriqueAndCountByAlph();
            return $this->render('EchyzenNewsBundle:News:index.html.twig', $array);
            
        }
    } // getVue()

    /**
    *   fonction permettant de retourner le nombre de news par mois
    *   cad retourne un tableau comportant des tableaux de type ('date' => dateTime, 'count' => int)
    */
    private function getCountByMonth() {
        $em = $this->getDoctrine()->getManager();
        $subres = $res = array();
        $subres = $em->getRepository('EchyzenNewsBundle:News')->getCountByMonth();
        
        foreach($subres as $oneMonth)
        {
            $date = new \DateTime();
            $date->setDate(intval($oneMonth['year']), intval($oneMonth['month']), 1);
            array_push($res, array( 'date' => $date, 'count' => $oneMonth['nbNews']));
        }
        
        return $res;

    } // getNewsByMonth()

}

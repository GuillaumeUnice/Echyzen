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
    * A faire : par ordre de date de création
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
        $array['entities']/*$entity*/ = $em->getRepository('EchyzenNewsBundle:News')
            ->findBy(array('id' => $id));

           // die($array['entities']->getContenu());

        if (!$array['entities']) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        return self::vue($array);
        /*return $this->render('EchyzenNewsBundle:News:show.html.twig', array(
            'entity'      => $entity,
        ));*/
    }


    public function getByMonthAction($year, $month) {
        $em = $this->getDoctrine()->getManager();
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')->getByMonth($year, $month);
        // si le résultat est vide on retourne l'index
        if($array['entities'] == null) {
            return self::indexAction();
        }

        return self::vue($array);
    }
    public function getByRubriqueAction ($id)
    {
        $em = $this->getDoctrine()->getManager();
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')->getByRubrique($id);
        // si le résultat est vide on retourne l'index
        if($array['entities'] == null) {
            return self::indexAction();
        }
        return self::vue($array);     
    }

    public function getByMotCleAction ($id)
    {
        $em = $this->getDoctrine()->getManager();
        $array['entities'] = $em->getRepository('EchyzenNewsBundle:News')->getByMotCle($id);
        // si le résultat est vide on retourne l'index
        if($array['entities'] == null) {
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
    public function getCountByRubrique() {

    } // getCountByRubrique()

    /**
    *   fonction permettant de retourner le nombre de news par mois
    *   cad retourne un tableau ayant en clé mois&Année ex : Janvier 2014
    *   et en valeur un array composer des clé : count, year, month
    */
    public function getCountByMonth() {
        $em = $this->getDoctrine()->getManager();
        
        /*
        $test = $em->getRepository('EchyzenNewsBundle:News')->getCountByMotCle();
        die(print_r($test));*/








        $year = 2014;
        $month = 5;
        $today = new \DateTime();
        $res = array();

        while(($year != date_format($today, 'Y')) || ($month <= date_format($today, 'm') )) {
            // retourne le nombre de news présente pour un mois précis
            $count = $em->getRepository('EchyzenNewsBundle:News')->getCountByMonth($year, $month);
            if($count) {
                //$subres = array($count, $year, $month);
                $subres = array('count' => $count, 'year' => $year, 'month' => $month);

                $res[self::getMonth($month) . ' ' . $year] = $subres;
            }

            if($month < 12) {
                $month++;
            } else {
                $month = 0;
                $year++;
            }
        }
        return $res;
    } // getNewsByMonth()

    /**
    * fonction permettant la "traduction" des months passage ex : 1 => Janvier
    * @param $month nombre a traduire en mois litéral
    */
    private function getMonth($month) {
        switch ($month) {
            case 1:
                return 'Janvier';
            case 2:
                return 'Fevrier';
            case 3:
                return 'Mars';
            case 4:
                return 'Avril';
            case 5:
                return 'Mai';
            case 6:
                return 'Juin';
            case 7:
                return 'Juillet';
            case 8:
                return 'Aout';
            case 9:
                return 'Septembre';
            case 10:
                return 'Octobre';
            case 11:
                return 'Novembre';
            default:
                return 'Décembre';
        }
    }
}

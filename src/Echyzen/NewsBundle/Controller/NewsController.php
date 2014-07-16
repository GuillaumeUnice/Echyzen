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

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EchyzenNewsBundle:News')->findAll();
        $array_test = array();
        foreach ($entities as $key => $value) {
            $array_test[$key] = $em->getRepository('EchyzenNewsBundle:Rubrique')->find($value->getRubrique());
        }

        $image = new Image();
        $form = $this->createForm(new ImageType, $image);
        $request = $this->getRequest();
        if( $request->getMethod() == "POST") {
            $form->handleRequest($request);
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($image);
                $em->flush();
            }
        }

        $rubriques = $em->getRepository('EchyzenNewsBundle:Rubrique')->getRubriqueByAlph();

        return $this->render('EchyzenNewsBundle:News:index.html.twig', array(
            'entities' => $entities,
            'test' => $array_test,
            'rubriques' => $rubriques,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        return $this->render('EchyzenNewsBundle:News:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Creates a form to delete a News entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function getByRubriqueAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EchyzenNewsBundle:News')->getByRubrique($id);

        /* marche pour envoyer du JSON s'assurer que le repository return un getArrayResult()
        $response = new JsonResponse();
        $response->setData($entities);
        return $response;*/
        

        $json = array();
        $json['html'] = $this->renderView('EchyzenNewsBundle:News:index_show.html.twig', array(
            'entities' => $entities
        ));
        /*$response = new Response(json_encode($json));
        $response->headers->set('Content-Type', 'application/json');
        return $response;*/

        $response = new Response();

$response->setContent($json['html']);
$response->setStatusCode(200);
$response->headers->set('Content-Type', 'text/html');
        
return $response;


        /*ancien
        $lReturn = array();
        //use renderview instead of render, because renderview returns the rendered template
        $lReturn['html'] = $this->renderView('EchyzenNewsBundle:News:index_show.html.twig', array(
            'entities' => $entities
        ));
        die($lReturn['html']);
        return new Response(json_encode($lReturn), 200, array('Content-Type'=>'application/json'));*/
        /*return $this->render('EchyzenNewsBundle:News:index_show.html.twig', array(
            'entities' => $entities,
        ));*/
        
       
    }

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
}

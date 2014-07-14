<?php

namespace Echyzen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Echyzen\NewsBundle\Entity\News;
use Echyzen\NewsBundle\Form\NewsType;
use Echyzen\NewsBundle\Form\NewsEditType;

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

    /**
     * Affiche un formulaire pour créer une nouvelle news
     *
     */
    public function createAction()
    {
        $news = new News();
        $form = $this->createForm(new NewsType, $news);

        //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();
        if($request->getMethod() == 'POST') {
            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            // vérification de la validité
            if($form->isValid()) {
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();
            }
        }

        return $this->render('EchyzenAdminBundle:news:create.html.twig', array(
            'news' => $news,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Rubrique entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenNewsBundle:News')->find($id);
 
        if (!$entity) {
            $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Page inexistante'
                );

            return $this->redirect($this->generateUrl('admin_news_liste'));
        }

        //Mise en place du formulaire d'edition de news
        $form = $this->createForm(new NewsEditType, $entity);

       
        //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();
        if($request->getMethod() == 'POST') {
            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            // vérification de la validité
            if($form->isValid()) {
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Vos changements ont été sauvegardés!'
                );

                 return $this->redirect($this->generateUrl('admin_news_liste'));
            }
        }

       // $editForm = $this->createEditForm($entity);
        

        return $this->render('EchyzenAdminBundle:news:edit.html.twig', array(
            'form' => $form->createView(),
         //   'edit_form'   => $editForm->createView(),
        ));
    } // editAction()
    
    /**
     * Deletes a News entity.
     *
     */
    public function deleteAction($id)
    {

        
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EchyzenNewsBundle:News')->find($id);

            if (!$entity) {
                // Pour le moment une exception mais par la suite une redirection ;)
                throw $this->createNotFoundException('Unable to find Rubrique entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('admin_news_liste'));
    }
}

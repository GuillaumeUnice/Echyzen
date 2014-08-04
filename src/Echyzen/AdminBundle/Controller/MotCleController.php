<?php

namespace Echyzen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Echyzen\NewsBundle\Entity\MotCle;
use Echyzen\NewsBundle\Form\MotCleType;

class MotCleController extends Controller
{
    public function listeAction()
    {
         $em = $this->getDoctrine()->getManager();

        //Mise en place du formulaire d'ajout de mot-clé
        $motCle = new MotCle();
        $form = $this->createForm(new MotCleType(), $motCle);
        
        //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();
        if($request->getMethod() == 'POST') {
            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            // vérification de la validité
            if($form->isValid()) {
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($motCle);
                $em->flush();
            }
        }
        
        // recupération de l'ensemble des mot-clés
        $entities = $em->getRepository('EchyzenNewsBundle:MotCle')->findAll();

        return $this->render('EchyzenAdminBundle:MotCle:liste.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a MotCle entity.
     *
     */
    public function deleteAction($id)
    {

        
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EchyzenNewsBundle:MotCle')->find($id);

            if (!$entity) {
                // Pour le moment une exception mais par la suite une redirection ;)
                throw $this->createNotFoundException('Unable to find MotCle entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('admin_motcle_liste'));
    }

    public function createAction() {
         $em = $this->getDoctrine()->getManager();
        //Mise en place du formulaire d'ajout de mot-cl"
        $motCle = new MotCle();
        $form = $this->createForm(new MotCleType(), $motCle);
                //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {

            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            
            // vérification de la validité
            if($form->isValid()) {
                
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($motCle);
                
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Le mot-clé a été enregistré'
                );
            }
        }
        return $this->render('EchyzenAdminBundle:MotCle:create.html.twig', array(
            'form' => $form->createView(),
        ));

    }
     /**
     * Displays a form to edit an existing MotCle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenNewsBundle:MotCle')->find($id);
 
        if (!$entity) {
            $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Page inexistante'
                );

                return $this->redirect($this->generateUrl('admin_motcle_liste'));
        }
        
        //Mise en place du formulaire d'ajout de mot-clé
        $form = $this->createForm(new MotCleType, $entity);

       
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

                 return $this->redirect($this->generateUrl('admin_motcle_liste'));
            }
        }

       // $editForm = $this->createEditForm($entity);
        

        return $this->render('EchyzenAdminBundle:MotCle:edit.html.twig', array(
            'form' => $form->createView(),
         //   'edit_form'   => $editForm->createView(),
        ));
    }
}

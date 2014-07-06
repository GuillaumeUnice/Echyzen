<?php

namespace Echyzen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Echyzen\NewsBundle\Entity\Rubrique;
use Echyzen\NewsBundle\Form\RubriqueType;
use Echyzen\NewsBundle\Form\RubriqueEditType;

class RubriqueController extends Controller
{
    public function listeAction()
    {
         $em = $this->getDoctrine()->getManager();

        //Mise en place du formulaire d'ajout de rubrique
        $rubrique = new Rubrique();
        $form = $this->createForm(new RubriqueType(), $rubrique);
        
        //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();
        if($request->getMethod() == 'POST') {
            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            // vérification de la validité
            if($form->isValid()) {
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($rubrique);
                $em->flush();
            }
        }
        
        // recupération de l'ensemble des rubriques
        $entities = $em->getRepository('EchyzenNewsBundle:Rubrique')->findAll();

        return $this->render('EchyzenAdminBundle:Rubrique:liste.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));
    }

     /**
     * Displays a form to edit an existing Rubrique entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenNewsBundle:Rubrique')->find($id);
 
        if (!$entity) {
            $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Page inexistante'
                );

                return $this->redirect($this->generateUrl('admin_rubrique_liste'));
        }
        
        //Mise en place du formulaire d'ajout de rubrique
        $form = $this->createForm(new RubriqueEditType, $entity);

       
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

                 return $this->redirect($this->generateUrl('admin_rubrique_liste'));
            }
        }

       // $editForm = $this->createEditForm($entity);
        

        return $this->render('EchyzenAdminBundle:Rubrique:edit.html.twig', array(
            'entity'      => $entity,
            'form' => $form->createView(),
         //   'edit_form'   => $editForm->createView(),
        ));
    }
}

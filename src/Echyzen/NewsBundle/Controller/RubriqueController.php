<?php

namespace Echyzen\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Echyzen\NewsBundle\Entity\Rubrique;
use Echyzen\NewsBundle\Form\RubriqueType;

/**
 * Rubrique controller.
 *
 */
class RubriqueController extends Controller
{

    /**
     * Lists all Rubrique entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        //Mise en place du formulaire d'ajout de rubrique
        $rubrique = new Rubrique();
        $form = $this->createForm(new RubriqueType, $rubrique);
        
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

        

        return $this->render('EchyzenNewsBundle:Rubrique:index.html.twig', array(
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
            throw $this->createNotFoundException('Unable to find Rubrique entity.');
        }

        //Mise en place du formulaire d'ajout de rubrique
        $form = $this->createForm(new RubriqueType, $entity);

       
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
            }
        }

       // $editForm = $this->createEditForm($entity);
        

        return $this->render('EchyzenNewsBundle:Rubrique:edit.html.twig', array(
            'entity'      => $entity,
            'form' => $form->createView(),
         //   'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Rubrique entity.
    *
    * @param Rubrique $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Rubrique $entity)
    {
        $form = $this->createForm(new RubriqueType(), $entity, array(
            'action' => $this->generateUrl('rubrique_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Rubrique entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenNewsBundle:Rubrique')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rubrique entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('rubrique_edit', array('id' => $id)));
        }

        return $this->render('EchyzenNewsBundle:Rubrique:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Rubrique entity.
     *
     */
    public function deleteAction($id)
    {

        
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EchyzenNewsBundle:Rubrique')->find($id);

            if (!$entity) {
                // Pour le moment une exception mais par la suite une redirection ;)
                throw $this->createNotFoundException('Unable to find Rubrique entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('rubrique'));
    }

}

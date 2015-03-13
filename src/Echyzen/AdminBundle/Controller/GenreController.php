<?php

namespace Echyzen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Echyzen\TestBundle\Entity\Genre;
use Echyzen\TestBundle\Form\GenreType;

class GenreController extends Controller
{
    public function listeAction()
    {
         $em = $this->getDoctrine()->getManager();

        //Mise en place du formulaire d'ajout de genre
        $genre = new Genre();
        $form = $this->createForm(new GenreType(), $genre);
        
        //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();
        if($request->getMethod() == 'POST') {
            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            // vérification de la validité
            if($form->isValid()) {
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($genre);
                $em->flush();
            }
        }
        
        // recupération de l'ensemble des genres
        $entities = $em->getRepository('EchyzenTestBundle:Genre')->findAll();

        return $this->render('EchyzenAdminBundle:Genre:liste.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));
    }

    public function createAction() {
         $em = $this->getDoctrine()->getManager();
        //Mise en place du formulaire d'ajout de genre
        $genre = new Genre();
        $form = $this->createForm(new GenreType(), $genre);
                //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {

            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);
            
            // vérification de la validité
            if($form->isValid()) {
                
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($genre);
                
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Le genre a été enregistré'
                );
            }
        }
        return $this->render('EchyzenAdminBundle:Genre:create.html.twig', array(
            'form' => $form->createView(),
        ));

    }
     /**
     * Displays a form to edit an existing Genre entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenTestBundle:Genre')->find($id);
 
        if (!$entity) {
            $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Page inexistante'
                );

                return $this->redirect($this->generateUrl('admin_genre_liste'));
        }
        
        //Mise en place du formulaire d'ajout de genre
        $form = $this->createForm(new GenreType, $entity);

       
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

                 return $this->redirect($this->generateUrl('admin_genre_liste'));
            }
        }

        return $this->render('EchyzenAdminBundle:Genre:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a Genre entity.
     *
     */
    public function deleteAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EchyzenTestBundle:Genre')->find($id);

            if (!$entity) {
                // Pour le moment une exception mais par la suite une redirection ;)
                throw $this->createNotFoundException('Unable to find Test entity.');
            }
            
            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Le Genre a été supprimé!'
            );

        return $this->redirect($this->generateUrl('admin_genre_liste'));
    }
}

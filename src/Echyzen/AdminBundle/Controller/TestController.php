<?php

namespace Echyzen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Echyzen\TestBundle\Entity\Test;
use Echyzen\TestBundle\Form\TestType;
use Echyzen\TestBundle\Form\FilmType;
use Echyzen\TestBundle\Entity\Film;
use Echyzen\TestBundle\Entity\Livre;
use Echyzen\TestBundle\Entity\Video;


class TestController extends Controller
{

    private $pathEntity = 'Echyzen\TestBundle\Entity\\';
    private $pathForm = 'Echyzen\TestBundle\Form\\';

    /**
    * Récupération du type de Test en String lower
    *
    */
    private function getChildShortClassName($entity)
    {
            $reflect = new \ReflectionClass($entity);
            return strtolower($reflect->getShortName());
    }


    /**
    * Simple function which redirect to a vue wich contains differents entity we can administre
    * into the Test Administration
    *
    */
    public function indexAction() {
        return $this->render('EchyzenAdminBundle:Test:index.html.twig');
    }

    public function listeAction($type)
    {
        $em = $this->getDoctrine()->getManager();

        // recupération de l'ensemble des rubriques
        $entities = $em->getRepository('EchyzenTestBundle:' . ucfirst($type))->findAll();
        return $this->render('EchyzenAdminBundle:test:liste.html.twig', array(
            'entities' => $entities,
            'type' => $type
        ));
    }

    /**
     * Deletes a MotCle entity.
     *
     */
    public function deleteAction($id)
    {

        
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EchyzenTestBundle:Test')->find($id);

            if (!$entity) {
                // Pour le moment une exception mais par la suite une redirection ;)
                throw $this->createNotFoundException('Unable to find Test entity.');
            }
            
            $type = self::getChildShortClassName($entity);
            
            
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Le Test a été supprimé'
            );

        return $this->redirect($this->generateUrl('admin_test_liste', array( 'type' => $type)));
    }


    public function createAction($type) {
        
        $em = $this->getDoctrine()->getManager();
        $entity = $this->pathEntity . ucfirst($type);
        $formType = $this->pathForm . ucfirst($type) . 'Type';

        //Mise en place du formulaire d'ajout
        $test = new $entity;

        $form = $this->createForm(new $formType, $test);


        
        //recuperation du type d'envoie de donnée $_POST || $_GET
        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {

            //récupération et donc hydration du formulaire par le client
            $form->handleRequest($request);

            
            // vérification de la validité
            if($form->isValid()) {
                
                // récupération de l'entityManager
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($test);
                
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Le ' . ucfirst($type) . ' a été enregistré'
                );
            }
        }
        return $this->render('EchyzenAdminBundle:Test:create.html.twig', array(
            'form' => $form->createView(),
            'type' => $type
        ));

    }
     /**
     * Displays a form to edit an existing MotCle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenTestBundle:Test')->find($id);
 

        $type = self::getChildShortClassName($entity);
        if (!$entity) {
            $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Page inexistante'
                );

                return $this->redirect($this->generateUrl('admin_test_liste', array( 'type' => $type)));
        }

        $formEditType = $this->pathForm . ucfirst($type) . 'EditType';

        //Mise en place du formulaire d'ajout de mot-clé
        $form = $this->createForm(new $formEditType, $entity);

       
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

                 return $this->redirect($this->generateUrl('admin_test_liste', array( 'type' => $type)));
            }
        }

       // $editForm = $this->createEditForm($entity);
        

        return $this->render('EchyzenAdminBundle:Test:edit.html.twig', array(
            'form' => $form->createView(),
            'type' => $type,
         //   'edit_form'   => $editForm->createView(),
        ));
    }
}

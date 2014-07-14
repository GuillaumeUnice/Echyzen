<?php

namespace Echyzen\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Echyzen\NewsBundle\Entity\News;
use Echyzen\NewsBundle\Form\NewsType;

use Echyzen\NewsBundle\Entity\Image;
use Echyzen\NewsBundle\Form\ImageType;

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
     * Creates a new News entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new News();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('news_show', array('id' => $entity->getId())));
        }

        return $this->render('EchyzenNewsBundle:News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a News entity.
    *
    * @param News $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(News $entity)
    {
        $form = $this->createForm(new NewsType(), $entity, array(
            'action' => $this->generateUrl('news_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Affiche un formulaire pour créer une nouvelle news
     *
     */
    public function newAction()
    {
        $entity = new News();
        $form   = $this->createCreateForm($entity);

        return $this->render('EchyzenNewsBundle:News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EchyzenNewsBundle:News:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EchyzenNewsBundle:News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a News entity.
    *
    * @param News $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(News $entity)
    {
        $form = $this->createForm(new NewsType(), $entity, array(
            'action' => $this->generateUrl('news_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing News entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EchyzenNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('news_edit', array('id' => $id)));
        }

        return $this->render('EchyzenNewsBundle:News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a News entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EchyzenNewsBundle:News')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find News entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('news'));
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
}

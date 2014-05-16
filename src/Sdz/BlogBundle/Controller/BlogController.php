<?php

// src/Sdz/BlogBundle/Controller/BlogController.php

namespace Sdz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
  public function indexAction()
  {

  	$id = 5;
    return $this->render('SdzBlogBundle:Blog:index.html.php', array('id' => $id));

  }
  
  public function voirAction($id)
  {
     return new Response('test du parametre : ' . $id);
  }

  public function voirSlugAction($annee, $slug, $format)
  {
     return new Response('test du parametre : ' . $annee);
  }
}
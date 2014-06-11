<?php

namespace Echyzen\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EchyzenIndexBundle:Default:index.html.twig');
    }
}

<?php

namespace gestionsanteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('gestionsanteBundle:Default:index.html.twig');
    }
}

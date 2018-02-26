<?php

namespace EducationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EducationBundle:Default:index.html.twig');
    }

        public function SynopsisAction()
    {
        return $this->render('EducationBundle:contes:synopsis.html.twig');
    }
    public function GarderieAction()
    {
        return $this->render('EducationBundle:Garderie:garderie.html.twig');
    }
    public function Liste_garderieAction()
    {
        return $this->render('EducationBundle:Garderie:liste_garderie.html.twig');
    }
    public function Liste_CoursfrAction()
    {
        return $this->render('EducationBundle:Cours:liste_cours_fr.html.twig');
    }
    public function Liste_CoursangAction()
    {
        return $this->render('EducationBundle:Cours:liste_cours_ang.html.twig');
    }
    public function Liste_articles_scAction()
    {
        return $this->render('EducationBundle:Cours:liste_articles_scientifiques.html.twig');
    }


}

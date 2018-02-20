<?php

namespace gestionsanteBundle\Controller;

use gestionsanteBundle\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RendezVousController extends Controller
{
    public function listRendezVousAction()
    {
        $em=$this->getDoctrine()->getManager();
        $rendezVous=$em->getRepository(RendezVous::class)->findAll();
        $nb = count($rendezVous);
        return $this->render('gestionsanteBundle:RendezVous:list_rendez_vous.html.twig', array(
            'rdvs'=>$rendezVous, 'nb'=>$nb
        ));
    }

}

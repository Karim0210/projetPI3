<?php

namespace gestionsanteBundle\Controller;

use gestionsanteBundle\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function ajouterRendezVousAction(Request $request)
    {
        $RendezVous=new RendezVous();
        if($request->isMethod('POST'))
        {
            $em=$this->getDoctrine()->getManager();
            $RendezVous->setNom($request->request->get('nom'));
            $RendezVous->setPrenom($request->request->get('prenom'));
            $RendezVous->setDateRendezVous(new \DateTime($request->request->get('date')));
            $em->persist($RendezVous);
            $em->flush();
            return $this->redirectToRoute('list_rendez_vous');


        }
        return $this->render('gestionsanteBundle:RendezVous:ajouter_rendez_vous.html.twig', array(
        ));
    }

}

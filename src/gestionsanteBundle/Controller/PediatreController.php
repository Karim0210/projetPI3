<?php

namespace gestionsanteBundle\Controller;

use gestionsanteBundle\Entity\Pediatre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PediatreController extends Controller
{

    public function inscrirePediatreAction(Request $request)
    {
        $Pediatre=new Pediatre();
        if($request->isMethod('POST'))
        {
            $em=$this->getDoctrine()->getManager();
            $Pediatre->setNom($request->get('nom'));
            $Pediatre->setPrenom($request->get('prenom'));
            $Pediatre->setEmail($request->get('email'));
            $Pediatre->setAdresse($request->get('adresse'));
            $Pediatre->setPrix($request->get('prix'));
            $Pediatre->setSpecialite($request->get('specialite'));
            $Pediatre->setDescription($request->get('description'));
            $Pediatre->setFormation($request->get('formation'));
            $Pediatre->setParcours($request->get('parcours'));
            $Pediatre->setImage($request->get('image'));
            $Pediatre->setDemande("0");
            $Pediatre->setLikes("0");
            $Pediatre->setVues("0");
            $Pediatre->setRating("0");
            $em->persist($Pediatre);
            $em->flush();
            return $this->redirectToRoute('listePediatre');


        }
        return $this->render('gestionsanteBundle:Pediatre:inscriptionPediatre.html.twig', array(
            "pediatres"=>$Pediatre
        ));
    }

    public function listePediatreAction()
         {
             $em=$this->getDoctrine()->getManager();
             $Pediatre=$em->getRepository(Pediatre::class)->findAll();
             return $this->render('gestionsanteBundle:Pediatre:listePediatre.html.twig', array('pediatres'=>$Pediatre));
         }

    public function profilPediatreAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $Pediatre=$em->getRepository(Pediatre::class)->find($id);
        //var_dump($Pediatre);die;
        return $this->render('gestionsanteBundle:Pediatre:profilPediatre.html.twig',array('pediatres'=>$Pediatre));
    }



}

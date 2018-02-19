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
            $Pediatre->setQuiz("0");
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

    public function listePediatreTrierAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Pediatre=$em->getRepository(Pediatre::class)->findTrierDQL();
        for ( $i=0 ; $i<5 ; $i++)
        {
            $P[$i]=$Pediatre[$i];
        }
        return $this->render('gestionsanteBundle:Pediatre:listePediatreTrier.html.twig', array('pediatres'=>$P));
    }

    public function profilPediatreAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Pediatre=$em->getRepository(Pediatre::class)->find($id);
        $Pediatre->setVues($Pediatre->getVues()+1);
        $Pediatre->setRating(($Pediatre->getQuiz()*0.6)+($Pediatre->getLikes()*0.3)+($Pediatre->getVues()*0.1));
        $em->flush();
        return $this->render('gestionsanteBundle:Pediatre:profilPediatre.html.twig',array('pediatres'=>$Pediatre));
    }

    public function consulterPediatreAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $Pediatre=$em->getRepository(Pediatre::class)->find($id);
        if($request->isMethod('POST'))
        {
            $r=$request->request->get('result');
            $Pediatre->setQuiz($Pediatre->getQuiz()+$r);
            $em->flush();
            return $this->redirectToRoute('listePediatre');
        }
        return $this->render('gestionsanteBundle:Pediatre:quizPediatre.html.twig',array('pediatres'=>$Pediatre));
    }

    public function likePediatreAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Pediatre=$em->getRepository(Pediatre::class)->find($id);
        $Pediatre->setLikes($Pediatre->getLikes()+1);
        $em->flush();
        return $this->redirectToRoute('listePediatre');
    }



}

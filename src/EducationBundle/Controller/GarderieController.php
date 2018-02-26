<?php

namespace EducationBundle\Controller;

use EducationBundle\Form\GarderieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EducationBundle\Entity\Garderie;
use Symfony\Component\HttpFoundation\Request;

class GarderieController extends Controller
{
    public function ajoutergarderieAction(Request $request)
    {
        $garderie= new garderie();

        if ($request->isMethod('POST'))
        {

            $garderie->setRating(0);
            $garderie->setNom($request->get('nom'));
            $garderie->setAdresse($request->get('adresse'));
            $garderie->setDescription($request->get('description'));
            $garderie->setTarif($request->get('tarif'));
            $garderie->setFormule($request->get('formule'));
            $garderie->setImage($request->get('image'));


            $em = $this->getDoctrine()->getManager();
            $em->persist($garderie); // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $em->flush();

            $conte = $em->getRepository("EducationBundle:Garderie")->findAll();//recupere les valeurs des champs de la base de donnees
            return $this->render('EducationBundle:Garderie:ajoutergarderie.html.twig', array("garderie"=>$garderie));
        }
        return $this->render('EducationBundle:Garderie:ajoutergarderie.html.twig', array());
    }


    public function SupprimergarderieAction(Request $request,$id)
    {
        if($request)

            $em = $this->getDoctrine()->getManager();

        $garderie = $em->getRepository(Garderie::class)->find($id);

        $em->remove($garderie);
        $em->flush();
        return $this->redirectToRoute('affichergarderie');
    }

    public function affichergarderieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $garderie = $em->getRepository("EducationBundle:Garderie")->findAll();
        return $this->render('EducationBundle:Garderie:tableau_garderies.html.twig', array("garderie"=>$garderie));
    }


    public function UpdategarderieAction($id,Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $garderie = $em->getRepository(Garderie::class)->find($id);

        if ($request->isMethod('POST'))
        {

            // $conte->setId($request->get('Id'));
            $garderie->setNom($request->get('nom'));
            $garderie->setAdresse($request->get('adresse'));
            $garderie->setDescription($request->get('descprition'));
            $garderie->setTarif($request->get('tarif'));
            $garderie->setFormule($request->get('formule'));
            $garderie->setImage($request->get('image'));

            $em->persist($garderie);
            $em->flush();

            // return $this->redirectToRoute("modifierconte");

            $garderie = $em->getRepository("EducationBundle:Garderie")->findAll();
            return $this->render('EducationBundle:Garderie:tableau_garderies.html.twig', array("garderie"=>$garderie));

        }
        return $this->render('EducationBundle:Garderie:modifiergarderie.html.twig', array('garderie'=>$garderie));
    }


    public function AfficherlistegarderiesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $garderie = $em->getRepository("EducationBundle:Garderie")->findAll();
        $gard=$em->getRepository("EducationBundle:Garderie")->findTrierDQL();
        return $this->render('EducationBundle:Garderie:liste_garderie.html.twig', array("garderie"=>$garderie,"gard"=>$gard));
    }

    public function afficherunegarderieAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $garderie = $em->getRepository(Garderie::class)->find($id);
        $form=$this->createForm(GarderieType::class,$garderie);

        $x=$garderie->getRating();
        if($form->handleRequest($request)->isValid()) {
            $y=$garderie->getRating();

            $garderie->setRating($x+$y);


            $em->persist($garderie);
            $em->flush();
            return $this->redirectToRoute('gard');

        }

        $newtarif=0;
        if (isset($_POST['ok']))
        {
            $nbr=$request->request->get('nbre');
            $oldtarif=$garderie->getTarif();

            if ($nbr==1)
            {
                $newtarif=$oldtarif;
            }
            if ($nbr==2)
            {
                $newtarif=$oldtarif+$oldtarif*0.75;
            }
            if (($nbr)==3)
            {
                $newtarif=2*$oldtarif+$oldtarif*0.5;
            }
            if (($nbr)>3)
            {
                $newtarif=3*$oldtarif+$oldtarif*0.10;
            }





            return $this->render('EducationBundle:Garderie:garderie.html.twig', array('garderie'=>$garderie,'newtarif'=>$newtarif,'f'=>$form->createView()));

        }
        return $this->render('EducationBundle:Garderie:garderie.html.twig', array('garderie'=>$garderie,'newtarif'=>$newtarif,'f'=>$form->createView()));
    }


    public function CalculerPromotionAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $gar = $em->getRepository(Garderie::class)->find($id);
       // $tarif=$gar->getTarif();
        $tarif=$gar->getTarif();


      if ($request->getMethod()=="POST")
{
   $request->get('nbre');
    if ($gar->getNbreEnfants()==2)
        {
            $tarif=$tarif+$tarif*0.75;
        }
    if ($gar->getNbreEnfants()==3)
    {
        $tarif=$tarif+$tarif*0.5;
    }
    if ($gar->getNbreEnfants()>=3)
    {
        $tarif=$tarif+$tarif*0.25;
    }
    return $this->render('EducationBundle:Garderie:garderie.html.twig', array('gar'=>$gar,'tarif'=>$tarif));

}
        return $this->render('EducationBundle:Garderie:garderie.html.twig', array('gar'=>$gar,'tarif'=>$tarif));

    }


}

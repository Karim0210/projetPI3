<?php

namespace EducationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EducationBundle\Entity\conte;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


class conteController extends Controller
{
    public function AjouterconteAction(Request $request)
    {
        $conte= new conte();

        if ($request->isMethod('POST'))
        {

          //  $conte->setFichier($request->get('fichier'));
            $conte->setRating($request->get('rating'));
            $conte->setNom($request->get('nom'));
            $conte->setAuteur($request->get('auteur'));
            $conte->setText($request->get('texte'));
            $conte->setViews($request->get('views'));
            $conte->setCategorie($request->get('categorie'));
            $conte->setImage($request->get('image'));


            $em = $this->getDoctrine()->getManager();
            $em->persist($conte); // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $em->flush();

            $conte = $em->getRepository("EducationBundle:conte")->findAll();//recupere les valeurs des champs de la base de donnees
            return $this->render('EducationBundle:contes:ajouterconte.html.twig', array("conte"=>$conte));
        }
        return $this->render('EducationBundle:contes:ajouterconte.html.twig', array());
    }


    public function downloadFileAction($nom)
    
    {
        $response = new BinaryFileResponse('images/'.$nom);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,$nom);
        return $response;
    }

    public function afficherconteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $conte = $em->getRepository("EducationBundle:conte")->findAll();//recupere les valeurs des champs de la base de donnees
        return $this->render('EducationBundle:contes:tab_contes.html.twig', array("conte"=>$conte));
    }

    public function supprimerconteAction($id,Request $request)
    {
        if($request)

            $em = $this->getDoctrine()->getManager();

        $conte = $em->getRepository(conte::class)->find($id);

        $em->remove($conte);
        $em->flush();
        return $this->redirectToRoute('lister');

    }



    public function UpdateconteAction($id,Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $conte = $em->getRepository(conte::class)->find($id);

        if ($request->isMethod('POST'))
        {

           // $conte->setId($request->get('Id'));
            $conte->setRating($request->get('rating'));
            $conte->setNom($request->get('nom'));
            $conte->setAuteur($request->get('auteur'));
            $conte->setText($request->get('texte'));
            $conte->setViews($request->get('views'));
            $conte->setCategorie($request->get('categorie'));
            $conte->setImage($request->get('image'));
            $em->persist($conte);
            $em->flush();

           // return $this->redirectToRoute("modifierconte");

            $conte = $em->getRepository("EducationBundle:conte")->findAll();
            return $this->render('EducationBundle:contes:tab_contes.html.twig', array("conte"=>$conte));

        }
        return $this->render('EducationBundle:contes:modifier_conte.html.twig', array('conte'=>$conte));
    }



    public function afficherlisteconteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $conte = $em->getRepository("EducationBundle:conte")->findAll();
        return $this->render('EducationBundle:contes:liste_contes.html.twig', array("conte"=>$conte));
    }


}

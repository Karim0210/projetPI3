<?php

namespace EducationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EducationBundle\Entity\Cours;
use Symfony\Component\HttpFoundation\Request;

class CoursController extends Controller
{
    public function AjoutercoursAction(Request $request)
    {
        $cours= new cours();

        if ($request->isMethod('POST'))
        {
            $cours->setNom($request->get('nom'));
            $cours->setRating($request->get('rating'));
            $cours->setType($request->get('type'));
            $cours->setNbre($request->get('nbre'));
            $cours->setAge($request->get('age'));
            $cours->setImage($request->get('image'));


            $em = $this->getDoctrine()->getManager();
            $em->persist($cours); // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $em->flush();

            $cours = $em->getRepository("EducationBundle:Cours")->findAll();//recupere les valeurs des champs de la base de donnees
            return $this->render('EducationBundle:Cours:ajoutercours.html.twig', array("cours"=>$cours));
        }
        return $this->render('EducationBundle:Cours:ajoutercours.html.twig', array());
    }

    public function AffichercoursAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EducationBundle:Cours")->findAll();//recupere les valeurs des champs de la base de donnees
        return $this->render('EducationBundle:Cours:liste_cours.html.twig', array("cours"=>$cours));
    }

    public function supprimercoursAction($id,Request $request)
    {
        if($request)

            $em = $this->getDoctrine()->getManager();

        $cours = $em->getRepository(Cours::class)->find($id);

        $em->remove($cours);
        $em->flush();
        return $this->redirectToRoute('affichercours');

    }


    public function UpdateCoursAction($id,Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository(Cours::class)->find($id);

        if ($request->isMethod('POST'))
        {

            // $cours->setId($request->get('Id'));
            $cours->setNOM($request->get('nom'));
            $cours->setRating($request->get('rating'));
            $cours->setType($request->get('type'));
            $cours->setNbre($request->get('nbre'));
            $cours->setAge($request->get('age'));
            $cours->setImage($request->get('image'));
            $em->persist($cours);
            $em->flush();

            // return $this->redirectToRoute("modifiercours");

            $cours = $em->getRepository("EducationBundle:Cours")->findAll();//recupere les valeurs des champs de la base de donnees
            return $this->render('EducationBundle:Cours:liste_cours.html.twig', array("cours"=>$cours));

        }
        return $this->render('EducationBundle:Cours:modifiercours.html.twig', array('cours'=>$cours));
    }

    public function afficherlistecoursAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EducationBundle:Cours")->findAll();//recupere les valeurs des champs de la base de donnees
        return $this->render('EducationBundle:Cours:liste_cours_fr.html.twig', array("cours"=>$cours));
    }

    public function coursfAction()
    {
        return $this->render('EducationBundle:Cours:cours_fr.html.twig', array());

    }
    public function coursfrAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository(Cours::class)->find($id);

        if ($request->isMethod('POST'))
        {


            $cours->setNOM($request->get('nom'));
            $cours->setRating($request->get('rating'));
            $cours->setType($request->get('type'));
            $cours->setNbre($request->get('nbre'));
            $cours->setAge($request->get('age'));
            $cours->setImage($request->get('image'));
            $em->persist($cours);
            $em->flush();


            $cours = $em->getRepository("EducationBundle:Cours")->findAll();
            return $this->render('EducationBundle:Cours:cours_fr.html.twig', array("cours"=>$cours));

        }
        return $this->render('EducationBundle:Cours:cours_fr.html.twig', array('cours'=>$cours));
    }

}

<?php

namespace EducationBundle\Controller;

use EducationBundle\Entity\Jeux;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class JeuxController extends Controller
{



    public function AjouterJeuxAction(Request $request)
    {
        $jeu= new Jeux();
        if($request->isMethod('POST')) {
            $jeu->setTitre($request->get('titre'));
            $jeu->setAge($request->get('age'));
            $jeu->setCategories($request->get('categorie'));
            $jeu->setInstructions($request->get('instructions'));
            $jeu->setImage($request->get('image'));

            $em=$this->getDoctrine()->getManager();
            $em->persist($jeu);
            $em->flush();
            $conte = $em->getRepository("EducationBundle:Jeux")->findAll();//recupere les valeurs des champs de la base de donnees
            return $this->render('EducationBundle:jeux:ajouterjeux.html.twig', array("jeu"=>$jeu));
        }
        return $this->render('EducationBundle:jeux:ajouterjeux.html.twig', array("jeu"=>$jeu));

    }

    public function afficherjeuxAction()
    {

        $em=$this->getDoctrine()->getManager();
        $jeu=$em->getRepository('EducationBundle:Jeux')->findAll();
        return $this->render('EducationBundle:jeux:tab_jeux.html.twig', array("jeu"=>$jeu));

    }

    public function supprimerJeuxAction($id,Request $request)
    {
        if($request)

            $em = $this->getDoctrine()->getManager();

        $jeu = $em->getRepository(Jeux::class)->find($id);

        $em->remove($jeu);
        $em->flush();
        return $this->redirectToRoute('afficherjeu');

    }

    public function UpdatejeuAction($id,Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $jeu = $em->getRepository(Jeux::class)->find($id);

        if ($request->isMethod('POST'))
        {
            $jeu->setTitre($request->get('titre'));
            $jeu->setAge($request->get('age'));
            $jeu->setCategories($request->get('categorie'));
            $jeu->setInstructions($request->get('instructions'));
            $jeu->setImage($request->get('image'));
            $em->persist($jeu);
            $em->flush();


            $jeu = $em->getRepository("EducationBundle:Jeux")->findAll();
            return $this->render('EducationBundle:jeux:tab_jeux.html.twig', array("jeu"=>$jeu));

        }
        return $this->render('EducationBundle:Jeux:modifierjeu.html.twig', array('jeu'=>$jeu));
    }

    public function ShowJeuxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $jeu = $em->getRepository("EducationBundle:Jeux")->findAll();//recupere les valeurs des champs de la base de donnees
        return $this->render('EducationBundle:jeux:liste_jeux.html.twig', array("jeu"=>$jeu));
    }




}

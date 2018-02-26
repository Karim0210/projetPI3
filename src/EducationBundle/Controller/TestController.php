<?php

namespace EducationBundle\Controller;

use EducationBundle\Entity\test;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{

    public function ajouterTestAction(Request $request)
    {
        $test = new test();
        $em = $this->getDoctrine()->getManager();

        $conte=$em->getRepository('EducationBundle:conte')->findAll();
        if ($request->isMethod('POST'))
        {

            $test->setQuestion($request->get('question'));
            $test->setReponse($request->get('reponse'));
            $test->setage($request->get('age'));
            $test->setCategorie($request->get('categorie'));
            $test->setNom($request->get('nom'));
            $test->setProp1($request->get('prop1'));
            $test->setProp2($request->get('prop2'));
            $test->setProp3($request->get('prop3'));
            $cnt=$this->getDoctrine()->getRepository('EducationBundle:conte')->find($request->get('conte'));
            $test->setConte($cnt);

            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();

            $conte = $em->getRepository("EducationBundle:Test")->findAll();
            return $this->render('EducationBundle:test:ajouter_test.html.twig', array("test"=>$test,'conte'=>$conte));
        }
        return $this->render('EducationBundle:test:ajouter_test.html.twig', array('conte'=>$conte));

    }

    public function AfficherTestAction()
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository("EducationBundle:test")->findAll();
        return $this->render('EducationBundle:test:tab_tests.html.twig', array("test"=>$test));
    }


    public function supprimerTestAction($id,Request $request)
    {
        if($request)

            $em = $this->getDoctrine()->getManager();

        $test = $em->getRepository(test::class)->find($id);

        $em->remove($test);
        $em->flush();
        return $this->redirectToRoute('affichertest');

    }


    public function UpdateTestAction($id,Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository(test::class)->find($id);

        if ($request->isMethod('POST'))
        {


            $test->setQuestion($request->get('question'));
            $test->setReponse($request->get('reponse'));
            $test->setage($request->get('age'));
            $test->setCategorie($request->get('categorie'));
            $test->setNom($request->get('nom'));
            $test->setProp1($request->get('prop1'));
            $test->setProp2($request->get('prop2'));
            $test->setProp3($request->get('prop3'));
            $test->setConte($request->get('conte'));

            $em->persist($test);
            $em->flush();


            $test = $em->getRepository("EducationBundle:test")->findAll();
            return $this->render('EducationBundle:test:modifier_test.html.twig', array("test"=>$test));

        }
        return $this->render('EducationBundle:test:modifier_test.html.twig', array('test'=>$test));
    }

    public function ScoreTestAction(Request $request)
    {

    }


    public function CreateTestAction($id,Request $request)
    {


        $niv=0;

        $score=0;
        $totalscore=0;
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('EducationBundle:test')->findBy(array('conte'=>$id));
        $test2= $em->getRepository('EducationBundle:test')->findBy(array('enfant'=>1));
        $user=$em->getRepository('EducationBundle:Enfant')->find(1);


        if($request->getMethod()=="POST")
      {


          foreach ($test as $t)
          {
              $score=0;
              $x=$request->get($t->getId());
        //  $y=$request->get('reponse2');
          //$z=$request->get('reponse3');
            //var_dump($t->getReponse());



              if($t->getReponse()==$x)
              {
                  $score++;
                  $totalscore++;
              }

              $test=$t->setScore($score);
              $em->flush();
          }
          foreach ($test2 as $tt)
          {



              $niv=($tt->getScore()+$niv)*2;
              $user->setNiveau($niv);
              $em->flush();
          }



              return $this->render('EducationBundle:Test:quizz.html.twig',array('test'=>$test,'res'=>$totalscore,'niveau'=>$niv));
          //var_dump($score);
      }


      return $this->render('EducationBundle:Test:quizz.html.twig',array('test'=>$test,'res'=>$score,'niveau'=>$niv));
       // return $score;



    }
    public function CalculerNiveauAction($id,Request $request)
    {
     $em=$this->getDoctrine()->getManager();
     $niveau=$em->getRepository('EducationBundle:test')->findBy(array('enfant'=>$id));

    }





}

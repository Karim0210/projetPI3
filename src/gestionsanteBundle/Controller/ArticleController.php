<?php

namespace gestionsanteBundle\Controller;

use gestionsanteBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    public function listeArticleAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Article=$em->getRepository(Article::class)->findAll();
        $ArticleTrier=$em->getRepository(Article::class)->findTrierVuesDQL();
        $ArticleNote=$em->getRepository(Article::class)->findTrierDQL();
        for ( $i=0 ; $i<3 ; $i++)
        {
            $A[$i]=$ArticleTrier[$i];
            $AN[$i]=$ArticleNote[$i];

        }
        return $this->render('gestionsanteBundle:Article:liste_article.html.twig', array(
            'articles'=>$Article,
            'articlesTri'=>$A,
            'articlesNote'=>$AN

        ));
    }

    public function listeArticleTrierAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Article=$em->getRepository(Article::class)->findTrierDQL();
        for ( $i=0 ; $i<3 ; $i++)
        {
            $A[$i]=$Article[$i];
        }
        return $this->render('gestionsanteBundle:Article:liste_article_Trier.html.twig', array('articles'=>$A));
    }


    public function ajouterTutorielAction(Request $request)
    {
        $Article=new Article();
        if($request->isMethod('POST'))
        {
            $em=$this->getDoctrine()->getManager();
            $Article->setNom($request->request->get('nom'));
            $Article->setAutheur($request->request->get('autheur'));
            $Article->setText($request->request->get('text'));
            $Article->setType("tutoriel");
            $em->persist($Article);
            $em->flush();
            return $this->redirectToRoute('liste_tutoriel');


        }
        return $this->render('gestionsanteBundle:Article:ajouterTutoriel.html.twig', array(
            "Articles"=>$Article
        ));
    }

    public function listeTutorielAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Article=$em->getRepository(Article::class)->findAll();
        return $this->render('gestionsanteBundle:Article:liste_tutoriel.html.twig', array('articles'=>$Article));
    }

    public function afficherArticleAction($id)
{
    $em=$this->getDoctrine()->getManager();
    $Article=$em->getRepository(Article::class)->find($id);
    //var_dump($Pediatre);die;
    return $this->render('gestionsanteBundle:Article:afficherArticle.html.twig',array('articles'=>$Article));
}



    public function ajouterArticleAction(Request $request)
    {
        $Article=new Article();
        if($request->isMethod('POST'))
        {
            $em=$this->getDoctrine()->getManager();
            $Article->setNom($request->request->get('nom'));
            $Article->setAutheur($request->request->get('autheur'));
            $Article->setText($request->request->get('text'));
            $Article->setType("article");
            $Article->setImage($request->request->get('image'));
            $em->persist($Article);
            $em->flush();
            return $this->redirectToRoute('liste_article');


        }
        return $this->render('gestionsanteBundle:Article:ajouterArticle.html.twig', array(
            "Articles"=>$Article
        ));
    }

}

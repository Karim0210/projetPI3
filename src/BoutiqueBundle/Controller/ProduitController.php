<?php

namespace BoutiqueBundle\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\Session\Session;



use BoutiqueBundle\Entity\Boutique;
use BoutiqueBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProduitController extends Controller
{

    public function CreateAction(Request $request)
    {


        $m1 = new Produit();


        if (isset($_POST['Save']))
        {
            $m1->setNom($request->request->get('NomProduit'));
            $boutique=$this->getDoctrine()->getRepository(Boutique::class)->find(12);
            $m1->setBoutique($boutique);
            $m1->setPrix($request->request->get('Prix'));
            $m1->setQuantite($request->request->get('Quantite'));
            $m1->setDescription($request->request->get('Description'));
            $m1->setMarque($request->request->get('Marque'));
            $m1->setCouleur($request->request->get('Couleur'));
            $m1->setImage($request->request->get('Image'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($m1);
            $em->flush();
           // return $this->redirectToRoute('ShowProduct');
        }

        return $this->render('BoutiqueBundle:BackOfficeViews:GestionProduit.html.twig');
    }


    public function CreateeAction(Request $request,$id)
    {

        $m1 = new Produit();

        if (isset($_POST['Save']))
        {

            $m1->setNom($request->request->get('NomProduit'));
            $boutique=$this->getDoctrine()->getRepository(Boutique::class)->find($id);
            $m1->setBoutique($boutique);
            $m1->setPrix($request->request->get('Prix'));
            $m1->setQuantite($request->request->get('Quantite'));
            $m1->setDescription($request->request->get('Description'));
            $m1->setMarque($request->request->get('Marque'));
            $m1->setCouleur($request->request->get('Couleur'));
            $m1->setImage($request->request->get('Image'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($m1);
            $em->flush();
            // return $this->redirectToRoute('ShowProduct');
        }

        return $this->render('BoutiqueBundle:BackOfficeViews:GestionProduit.html.twig');
    }


    public function FrontProductByBoutiqueAction($id)
    {
       // $boutique=$this->getDoctrine()->getRepository(Boutique::class)->find($id);
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findByBoutique($id);

        return $this->render('BoutiqueBundle:FrontViews:ListeProduit.html.twig',['produits'=>$produits]);
    }




    public function ShowAction()
    {

        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();

        return $this->render('BoutiqueBundle:BackOfficeViews:ListeProduit.html.twig',['produits'=>$produits]);
    }

    public function PromoAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $produit = $em->getRepository(Produit::class)->find($id);
        $produit->setPromotion(1);
        if($produit->getPrix()>15)
        $produit->setTauxPromotion(20);
        $em->flush();
        return $this->redirectToRoute('ShowProduct');
    }


    public function DeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $produit = $em->getRepository(Produit::class)->find($id);
        $em->flush();
        return $this->redirectToRoute('ShowProduct');
    }

    public function fetchAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $produit= $em->getRepository(Produit::class)->find($id);
        return $this->render('BoutiqueBundle:BackOfficeViews:EditProduit.html.twig',['produit'=>$produit]);


    }

    public function UpdateAction(Request $request)
    {
        // $modeleId={{id}};
        $produitId=$request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $boutique=new Boutique();

        $produit = $em->getRepository(Produit::class)->find($produitId);
        if (!$boutique) {
            throw $this->createNotFoundException(
                'No product found for id '.$produitId
            );
        }
        $produit->setNom($request->request->get('Nom'));

        $produit->setPrix($request->request->get('Prix'));
        $produit->setQuantite($request->request->get('Quantite'));
        $produit->setDescription($request->request->get('Description'));
        $produit->setMarque($request->request->get('Marque'));
        $produit->setCouleur($request->request->get('Couleur'));
        $produit->setImage($request->request->get('Image'));



        $em->flush();

        return $this->redirectToRoute('ShowProduct');
    }

    public function FrontAction()
    {
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();


        return $this->render('BoutiqueBundle:FrontViews:ListeProduit.html.twig',['produits'=>$produits]);

    }




    public function DisplayProductAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $produit= $em->getRepository(Produit::class)->find($id);
        return $this->render('BoutiqueBundle:FrontViews:ProductDescription.html.twig',['produit'=>$produit]);

    }

}

<?php

namespace BoutiqueBundle\Controller;

use BoutiqueBundle\Entity\Boutique;
use BoutiqueBundle\Entity\Lignedecommande;
use BoutiqueBundle\Entity\Panier;
use BoutiqueBundle\Entity\Produit;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Cookie;


class BoutiqueController extends Controller
{
    public function CreateAction(Request $request)
    {

        $m1 = new Boutique();

        $m1->setNomBoutique($request->request->get('NomBoutique'));

        $m1->setNomResponsableBoutique($request->request->get('NomResponsableBoutique'));
        $m1->setAdresse($request->request->get('Adresse'));
        $m1->setContact($request->request->get('Contact'));
        $m1->setFournisseur($request->request->get('Fournisseur'));
        $m1->setType($request->request->get('TypeBoutique'));
        $m1->setImage($request->request->get('Image'));

        if (isset($_POST['Save']))
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($m1);
            $em->flush();
            return $this->redirectToRoute('ShowBoutique');
        }
        return $this->render('BoutiqueBundle:BackOfficeViews:GestionBoutique.html.twig');
    }

    public function ShowAction(Request $request)
    {

        $boutiques = $this->getDoctrine()->getRepository(Boutique::class)->findBy(array('id_user'=>$this->getUser()->getId()));
     /*   if (isset($_POST['Save1'])){
            $id=$request->get('id');
            var_dump(intval($id));
            $response=$this->forward('BoutiqueBundle:Produit:Create',array('idd'=>$id));

        }
*/
        return $this->render('BoutiqueBundle:BackOfficeViews:ListeBoutique.html.twig',['boutiques'=>$boutiques]);
    }

    public function DeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $boutique = $em->getRepository(Boutique::class)->find($id);
        $em->remove($boutique);
        $em->flush();
        return $this->redirectToRoute('ShowBoutique');
    }

    public function fetchAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $boutique = $em->getRepository(Boutique::class)->find($id);
        return $this->render('BoutiqueBundle:BackOfficeViews:EditBoutique.html.twig',['boutique'=>$boutique]);


    }

    public function UpdateAction(Request $request)
    {
        // $modeleId={{id}};
        $boutiqueId=$request->request->get('id');
        $em = $this->getDoctrine()->getManager();
            $boutique=new Boutique();

        $boutique = $em->getRepository(Boutique::class)->find($boutiqueId);
        if (!$boutique) {
            throw $this->createNotFoundException(
                'No product found for id '.$boutiqueId
            );
        }
        $boutique->setNomBoutique($request->request->get('NomBoutique'));
        $boutique->setNomResponsableBoutique($request->request->get('NomResponsableBoutique'));
        $boutique->setAdresse($request->request->get('Adresse'));
        $boutique->setContact($request->request->get('Contact'));
        $boutique->setFournisseur($request->request->get('Fournisseur'));
        $boutique->setType($request->request->get('TypeBoutique'));
        $boutique->setImage($request->request->get('Image'));


        $em->flush();

        return $this->redirectToRoute('ShowBoutique');
    }

    public function FrontAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paniers = $em->getRepository(Lignedecommande::class)->findByUserId(0);
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $boutiques = $this->getDoctrine()->getRepository(Boutique::class)->GetBestShopsDQL();

        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') )
        {
            $paniers = $em->getRepository(Lignedecommande::class)->NonSetCartUser($this->getUser()->getId());
            if ($paniers != null)
            {
                $prixTotal = 0;
                foreach ($paniers as $panier) {
                    $prixTotal += $panier->getPrixTotal();
                }
                $resultCount = count($paniers);
                return $this->render('BoutiqueBundle:FrontViews:ListBoutique.html.twig', array('produits' => $produits, 'boutiques' => $boutiques,'paniers' => $paniers, 'prixTotal' => $prixTotal,'resultCount' => $resultCount));

            }
        }



        if ($paniers != null)
        {

            $prixTotal = 0;
            foreach ($paniers as $panier) {
                $prixTotal += $panier->getPrixTotal();
            }
            $resultCount = count($paniers);


            return $this->render('BoutiqueBundle:FrontViews:ListBoutique.html.twig', array('produits' => $produits, 'boutiques' => $boutiques,'paniers' => $paniers, 'prixTotal' => $prixTotal,'resultCount' => $resultCount));

        }
        return $this->render('BoutiqueBundle:FrontViews:ListBoutique.html.twig', array('produits' => $produits, 'boutiques' => $boutiques));

    }






    public function DisplayBoutiquesAction()
    {
        $boutiques = $this->getDoctrine()->getRepository(Boutique::class)->findAll();

        return $this->render('BoutiqueBundle:FrontViews:AllBoutique.html.twig',['boutiques'=>$boutiques]);

    }
    public function DashboardAction()
    {
        $number= array('');
        $bouti= array('');
        $boutiques = $this->getDoctrine()->getRepository(Boutique::class)->findAll();
        foreach ($boutiques as $boutique)
        {
            array_push( $bouti , $boutique->getNomBoutique());
        }
        foreach ($boutiques as $boutique)
        {
            array_push( $number , $boutique->getTotalAchat());
        }

        $sellsHistory = array(
            array(
                "name" => "Total des ventes",
                "data" => $number
            ),


        );

        $ob = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $ob->chart->renderTo('barchart');
        $ob->title->text('Total de ventes des boutiques');

        $ob->yAxis->title(array('text' => "Ventes (milliers d'unité)"));

        $ob->xAxis->title(array('text'  => "Boutiques"));
        $ob->xAxis->categories($bouti);

        $ob->series($sellsHistory);



            return $this->render('BoutiqueBundle:Default:index.html.twig', array(
                'linechart' => $ob
            ));


    }


    public function FindBoutiqueByNameAction(Request $request)
    {

        $nom=$request->request->get('search');
        $boutiques = $this->getDoctrine()->getRepository(Boutique::class)->findBy(array('nomBoutique'=>$nom));
        return $this->render('BoutiqueBundle:FrontViews:AllBoutique.html.twig',['boutiques'=>$boutiques]);
    }
}

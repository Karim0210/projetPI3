<?php

namespace BoutiqueBundle\Controller;

use BoutiqueBundle\Entity\Commande;
use BoutiqueBundle\Entity\Lignedecommande;
use BoutiqueBundle\Entity\Panier;
use BoutiqueBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BoutiqueBundle:Default:index.html.twig');
    }

    public function ajouterauPanierAction($id)
    {


            $em = $this->getDoctrine()->getManager();
            $produit = $em->getRepository(Produit::class)->find($id);
            $test = $em->getRepository(Lignedecommande::class)->findExistant($id,$this->getUser()->getId());

            if(($produit != null)&&(empty($test)))
            {
                $lignedecommande = new Lignedecommande();
                $lignedecommande->setProduitId($produit->getId());
                $lignedecommande->setUserId($this->getUser()->getId()); //à changer avec le fos
                $lignedecommande->setNomProduit($produit->getNom());
              //  $lignedecommande->setDate(new \DateTime("now"));
               // $lignedecommande->setQuantite()
                $lignedecommande->setEtat(0);
                $lignedecommande->setPrixTotal($produit->getPrix());
                $em->persist($lignedecommande);
                $em->flush();
                $msg = "success";
                //    return $this->redirectToRoute('Dashboard');
            }
            else
            {
                //return $this->render('BoutiqueBundle:FrontViews:404.html.twig');
                $msg = "failure";
            }
            return new JsonResponse(array('msg' => $msg));
    }

    public function AfficherPanierAction()
    {
        $em = $this->getDoctrine()->getManager();
       $user = $this->getUser()->getId();
        $paniers = $em->getRepository(Panier::class)->findByUserId($this->getUser()->getId());

        if($paniers != null){
            $prixTotal = 0;
            foreach ($paniers as $panier)
            {
                $prixTotal += $panier->getPrixTotal();
            }
            $resultCount = count($paniers);
            return $this->render('BoutiqueBundle:FrontViews:Panier.html.twig', ['paniers' => $paniers, 'prixTotal' => $prixTotal,'resultCount' => $resultCount]);

        }
        return $this->render('BoutiqueBundle:FrontViews:404.html.twig');
    }

    public function AfficherProduitsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository(Produit::class)->findAll();
        $resultCount = count($produits);
        return $this->render('BoutiqueBundle:FrontViews:Produit.html.twig', ['produits' => $produits, 'resultCount' => $resultCount]);
    }

    public function UpdatePanierAction($id, Request $request, $body){
        $em = $this->getDoctrine()->getManager();
        $panier = $em->getRepository(Lignedecommande::class)->find($id);
        /*if($request->isMethod('POST')){
            $panier->setPrixTotal($panier->getPrixTotal()* $request->get('quantite'));
            if($request->get('quantite')<0){
                $em->remove($panier);
                $em->flush();
            }
            else{
                $em->persist($panier);
                $em->flush();
            }
        }*/
        $nouveauPrix = $panier->getPrixTotal()* $body;
        $panier->setPrixTotal($nouveauPrix);
        if($body <0){
            $em->remove($panier);
            $em->flush();
        }
        else{
            $em->persist($panier);
            $em->flush();
        }

        //return $this->redirectToRoute('boutique_homepage');
        return new JsonResponse(array("nouveauPrix" => $nouveauPrix ));
    }

    public function ValiderPanierAction()
    {
       // $user_id = $this->getUser()->getId(); //à modifier avec le fos!!!!
        $lignedecommandes=new Lignedecommande();
        $em = $this->getDoctrine()->getManager();
         $test = $em->getRepository(Lignedecommande::class)->TotalAchatUser($this->getUser()->getId());
        $lignedecommandes = $em->getRepository(Lignedecommande::class)->findByUserId($this->getUser()->getId());
        if(($lignedecommandes  != null)&&($test>1))
        {
            $user=$em->getRepository(User::class)->find($this->getUser()->getId());
            $user->setJeton($user->getJeton()+20);

              $t=0;

            foreach ($lignedecommandes  as $lignedecommande)
            {
                $t=$lignedecommande->getPrixTotal()+$t;
                $lignedecommande->setEtat(1);

                $em->flush();
            }
            $pani=new Panier();
            $pani->setEtat(1);
            $pani->setPrixTotal($t);
            $pani->setDate(new \DateTime("now"));
            $pani->setUserId($this->getUser()->getId());
            $em->persist($pani);
            $em->flush();

            $youLastRecord = $this->getDoctrine()->getRepository(Panier::class)->findOneBy(
                array(),
                array('id' => 'DESC')
            );

           // $c=$em->getRepository(Panier::class)->LastIdCart();
            $p=$this->getDoctrine()->getRepository(Panier::class)->find($youLastRecord);

            foreach ($lignedecommandes as $lignedecommande)
            {
                $lignedecommande->setPanier($p);
                $em->flush();
            }


            return $this->redirectToRoute('PasserCommande');

        }
        return $this->render('BoutiqueBundle:FrontViews:404.html.twig');

    }

    public function AjouterCommandeAction()
    {
        $em = $this->getDoctrine()->getManager();
        if(isset($_POST['Save']))
        {
            $commande = new Commande();
            $panier=$this->getDoctrine()->getRepository(Panier::class)->find($this->getUser()->getId());
            $commande->setPrixTotal($panier->getPrixTotal());
            $commande->setUserId($this->getUser()->getId()); //à modifier!!
            $commande->setDate(new \DateTime("now"));
            $commande->setModePaiement("PayPal");
            $commande->setValide(0);
            $em->persist($commande);
            $em->flush();
        }
        return $this->render('BoutiqueBundle:FrontViews:Commande.html.twig');
    }

}

<?php

namespace BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignedecommande
 *
 * @ORM\Table(name="lignedecommande")
 * @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\LignedecommandeRepository")
 */
class Lignedecommande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProduit", type="string", length=255, nullable=true)
     */
    private $nomProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="prixTotal", type="integer", nullable=true)
     */
    private $prixTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Panier")
     * @ORM\JoinColumn(name="id_panier",referencedColumnName="id")
     */
    private $panier;



    /**
     * @var int
     *
     * @ORM\Column(name="produitId", type="integer", nullable=true)
     */
    private $produitId;


    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer", nullable=true)
     */
    private $userId;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomProduit
     *
     * @param string $nomProduit
     *
     * @return Lignedecommande
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    /**
     * Get nomProduit
     *
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Lignedecommande
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Lignedecommande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set prixTotal
     *
     * @param integer $prixTotal
     *
     * @return Lignedecommande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return int
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }


    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Lignedecommande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }


    /**
     * Set Panier
     *
     * @param BoutiqueBundle\Entity\Panier $panier
     *
     * @return Lignedecommande
     */
    public function setPanier($panier)
    {
        $this->panier= $panier;

        return $this;
    }

    /**
     * Get Panier
     *
     * @return BoutiqueBundle\Entity\Panier
     */
    public function getPanier()
    {
        return $this->panier;
    }


    /**
     * Set produitId
     *
     * @param integer $produitId
     *
     * @return Lignedecommande
     */
    public function setProduitId($produitId)
    {
        $this->produitId = $produitId;

        return $this;
    }

    /**
     * Get produitId
     *
     * @return int
     */
    public function getProduitId()
    {
        return $this->produitId;
    }


}


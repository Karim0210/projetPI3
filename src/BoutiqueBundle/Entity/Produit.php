<?php

namespace BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float", nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="Disponiblite", type="string", length=255, nullable=true)
     */
    private $disponiblite;

    /**
     * @var int
     *
     * @ORM\Column(name="Promotion", type="integer", nullable=true)
     */
    private $promotion;



    /**
     * @var string
     *
     * @ORM\Column(name="Image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="Rating", type="integer", nullable=true)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="Marque", type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="Couleur", type="string", length=255, nullable=true)
     */
    private $couleur;

    /**
     * @var int
     *
     * @ORM\Column(name="TauxPromotion", type="integer", nullable=true)
     */
    private $tauxpromotion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebutPromo", type="date", nullable=true)
     */
    private $datedebutpromo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateFinPromo", type="date", nullable=true)
     */
    private $datefinpromo;

    /**
     * @ORM\ManyToOne(targetEntity="Boutique")
     * @ORM\JoinColumn(name="boutique_id",referencedColumnName="id")
     */
    private $boutique;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Produit
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
     * Set disponiblite
     *
     * @param string $disponiblite
     *
     * @return Produit
     */
    public function setDisponiblite($disponiblite)
    {
        $this->disponiblite = $disponiblite;

        return $this;
    }

    /**
     * Get disponiblite
     *
     * @return string
     */
    public function getDisponiblite()
    {
        return $this->disponiblite;
    }

    /**
     * Set promotion
     *
     * @param integer $promotion
     *
     * @return Produit
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return int
     */
    public function getPromotion()
    {
        return $this->promotion;
    }


    /**
     * Set tauxpromotion
     *
     * @param integer $tauxpromotion
     *
     * @return Produit
     */
    public function setTauxPromotion($tauxpromotion)
    {
        $this->tauxpromotion = $tauxpromotion;

        return $this;
    }

    /**
     * Get tauxpromotion
     *
     * @return int
     */
    public function getTauxPromotion()
    {
        return $this->tauxpromotion;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Produit
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Produit
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Produit
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Produit
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set Boutique
     *
     * @param BoutiqueBundle\Entity\Boutique $boutique
     *
     * @return Produit
     */
    public function setBoutique($boutique)
    {
        $this->boutique = $boutique;

        return $this;
    }

    /**
     * Get Boutique
     *
     * @return BoutiqueBundle\Entity\Boutique
     */
    public function getBoutique()
    {
        return $this->boutique;
    }




    /**
     * Set date
     *
     * @param \DateTime $datedebutpromo
     *
     * @return Produit
     */
    public function setDateDebutPromo($datedebutpromo)
    {
        $this->datedebutpromo = $datedebutpromo;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDateDebutPromo()
    {
        return $this->datedebutpromo;
    }



    /**
     * Set date
     *
     * @param \DateTime $datefinpromo
     *
     * @return Produit
     */
    public function setDateFinPromo($datefinpromo)
    {
        $this->datefinpromo = $datefinpromo;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDateFinPromo()
    {
        return $this->datefinpromo;
    }




}


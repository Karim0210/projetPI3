<?php

namespace BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boutique
 *
 * @ORM\Table(name="boutique")
 * @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\BoutiqueRepository")
 */
class Boutique
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
     * @ORM\Column(name="NomBoutique", type="string", length=255, nullable=true)
     */
    private $nomBoutique;

    /**
     * @var string
     *
     * @ORM\Column(name="NomResponsableBoutique", type="string", length=255, nullable=true)
     */
    private $nomResponsableBoutique;

    /**
     * @var string
     *
     * @ORM\Column(name="Contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Fournisseur", type="string", length=255, nullable=true)
     */
    private $fournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Image", type="string", length=255, nullable=true)
     */
    private $image;


    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $id_user;


    /**
     * @var int
     *
     * @ORM\Column(name="TotalAchat", type="integer", nullable=true)
     */
    private $totalachat;


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
     * Set nomBoutique
     *
     * @param string $nomBoutique
     *
     * @return Boutique
     */
    public function setNomBoutique($nomBoutique)
    {
        $this->nomBoutique = $nomBoutique;

        return $this;
    }

    /**
     * Get nomBoutique
     *
     * @return string
     */
    public function getNomBoutique()
    {
        return $this->nomBoutique;
    }

    /**
     * Set nomResponsableBoutique
     *
     * @param string $nomResponsableBoutique
     *
     * @return Boutique
     */
    public function setNomResponsableBoutique($nomResponsableBoutique)
    {
        $this->nomResponsableBoutique = $nomResponsableBoutique;

        return $this;
    }



    /**
     * Get nomResponsableBoutique
     *
     * @return string
     */
    public function getNomResponsableBoutique()
    {
        return $this->nomResponsableBoutique;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Boutique
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Boutique
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set fournisseur
     *
     * @param string $fournisseur
     *
     * @return Boutique
     */
    public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return string
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Boutique
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Boutique
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
     * Set image
     *
     * @param int $totalachat
     *
     * @return Boutique
     */
    public function setTotalAchat($totalachat)
    {
        $this->totalachat = $totalachat;

        return $this;
    }

    /**
     * Get totalachat
     *
     * @return int
     */
    public function getTotalAchat()
    {
        return $this->totalachat;
    }
}


<?php

namespace gestionsanteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sujet
 *
 * @ORM\Table(name="sujet")
 * @ORM\Entity(repositoryClass="gestionsanteBundle\Repository\SujetRepository")
 */
class Sujet
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
     * @ORM\Column(name="nomSujet", type="string", length=255)
     */
    private $nomSujet;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;


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
     * Set nomSujet
     *
     * @param string $nomSujet
     *
     * @return Sujet
     */
    public function setNomSujet($nomSujet)
    {
        $this->nomSujet = $nomSujet;

        return $this;
    }

    /**
     * Get nomSujet
     *
     * @return string
     */
    public function getNomSujet()
    {
        return $this->nomSujet;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Sujet
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }
}


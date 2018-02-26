<?php

namespace EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="EducationBundle\Repository\TestRepository")
 */
class test
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255)
     */
    private $reponse;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="prop1", type="string", length=255)
     */
    private $prop1;

    /**
     * @var string
     *
     * @ORM\Column(name="prop2", type="string", length=255)
     */
    private $prop2;
    /**
     * @var string
     *
     * @ORM\Column(name="prop3", type="string", length=255)
     */
    private $prop3;

    /**
     * @return mixed
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * @param mixed $enfant
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;
    }




    /**
     * @ORM\ManyToOne(targetEntity="conte")
     * @ORM\JoinColumn(name="conte",referencedColumnName="id",onDelete="CASCADE")
     */
    private $conte;

    /**
     * @ORM\ManyToOne(targetEntity="Enfant")
     * @ORM\JoinColumn(name="enfant",referencedColumnName="id",onDelete="CASCADE")
     */
    private $enfant;



    public function getConte()
    {
        return $this->conte;
    }

    /**
     * @param mixed $conte
     */
    public function setConte($conte)
    {
        $this->conte = $conte;
    }

    /**
     * @return string
     */
    public function getProp1()
    {
        return $this->prop1;
    }

    /**
     * @param string $prop1
     */
    public function setProp1($prop1)
    {
        $this->prop1 = $prop1;
    }

    /**
     * @return string
     */
    public function getProp2()
    {
        return $this->prop2;
    }

    /**
     * @param string $prop2
     */
    public function setProp2($prop2)
    {
        $this->prop2 = $prop2;
    }

    /**
     * @return string
     */
    public function getProp3()
    {
        return $this->prop3;
    }

    /**
     * @param string $prop3
     */
    public function setProp3($prop3)
    {
        $this->prop3 = $prop3;
    }






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
     * @return test
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
     * Set age
     *
     * @param integer $age
     *
     * @return test
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return test
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return test
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

    /**
     * Set reponse
     *
     * @param integer $reponse
     *
     * @return test
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return int
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return test
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}


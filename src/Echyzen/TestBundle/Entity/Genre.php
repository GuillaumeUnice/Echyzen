<?php

namespace Echyzen\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Genre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\TestBundle\Entity\GenreRepository")
 */
class Genre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     *
     * @Assert\Length(min=2, minMessage="La rubrique doit faire au moins {{min}} caractères")
     */
    private $nom;


    /**
    * @ORM\ManyToMany(targetEntity="Echyzen\TestBundle\Entity\Test", inversedBy="genres",  cascade={"persist"})
    */
    private $tests;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Rubrique
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
     * Constructor
     */
    public function __construct()
    {
        $this->tests = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add tests
     *
     * @param \Echyzen\TestBundle\Entity\Test $tests
     * @return Genre
     */
    public function addTest(\Echyzen\TestBundle\Entity\Test $tests)
    {
        $this->tests[] = $tests;

        return $this;
    }

    /**
     * Remove tests
     *
     * @param \Echyzen\TestBundle\Entity\Test $tests
     */
    public function removeTest(\Echyzen\TestBundle\Entity\Test $tests)
    {
        $this->tests->removeElement($tests);
    }

    /**
     * Get tests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTests()
    {
        return $this->tests;
    }
}

<?php

namespace Echyzen\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Rubrique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\NewsBundle\Entity\RubriqueRepository")
 */
class Rubrique
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
    * @ORM\OneToMany(targetEntity="Echyzen\NewsBundle\Entity\News", mappedBy="rubrique")
    */
    private $news;

    /**
    * @ORM\OneToOne(targetEntity="Echyzen\NewsBundle\Entity\Image", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=false)
    * @Assert\NotBlank()
    */
    private $image;

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
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add news
     *
     * @param \Echyzen\NewsBundle\Entity\News $news
     * @return Rubrique
     */
    public function addNews(\Echyzen\NewsBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Echyzen\NewsBundle\Entity\News $news
     */
    public function removeNews(\Echyzen\NewsBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set image
     *
     * @param \Echyzen\NewsBundle\Entity\Image $image
     * @return Rubrique
     */
    public function setImage(\Echyzen\NewsBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Echyzen\NewsBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}

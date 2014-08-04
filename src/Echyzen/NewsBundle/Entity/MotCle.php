<?php

namespace Echyzen\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * MotCle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\NewsBundle\Entity\MotCleRepository")
 */
class MotCle
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     *
     * @Assert\Length(min=2, minMessage="Le mot-clé doit faire au moins {{min}} caractères")
     */
    private $nom;

    /**
    *
    * @ORM\ManyToMany(targetEntity="Echyzen\NewsBundle\Entity\News", inversedBy="motCles",  cascade={"persist"})
    */
    private $news;

    public function __construct()
    {
       
        $this->news = new \Doctrine\Common\Collections\ArrayCollection(); // C'est un arrayCollection, il doit donc être initialisé
    }

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
     * Add news
     *
     * @param \Echyzen\NewsBundle\Entity\News $news
     * @return MotCle
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
}

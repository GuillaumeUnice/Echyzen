<?php

namespace Echyzen\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\NewsBundle\Entity\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
    * @ORM\ManyToOne(targetEntity="Echyzen\NewsBundle\Entity\News", inversedBy="commentaires")
    *
    * @ORM\JoinColumn(nullable=false)
    */
    private $news;

    /**
    * @ORM\ManyToOne(targetEntity="Echyzen\TestBundle\Entity\Test", inversedBy="commentaires")
    *
    * @ORM\JoinColumn(nullable=true)
    */
    private $test;

    public function __construct()
    {
        $this->date = new \Datetime(); // Par défaut, la date du commentaire

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
     * Set auteur
     *
     * @param string $auteur
     * @return Commentaire
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Commentaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
    * Set news
    *
    * @param Echyzen\NewsBundle\Entity\News $news
    */
    public function setNews(\Echyzen\NewsBundle\Entity\News $news)
    {
        $this->news = $news;
    }

    /**
    * Get news
    *
    * @return Echyzen\NewsBundle\Entity\News
    */
    public function getNews()
    {
        return $this->news;
    }



    /**
     * Set test
     *
     * @param \Echyzen\TestBundle\Entity\Test $test
     * @return Commentaire
     */
    public function setTest(\Echyzen\TestBundle\Entity\Test $test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \Echyzen\TestBundle\Entity\Test 
     */
    public function getTest()
    {
        return $this->test;
    }
}

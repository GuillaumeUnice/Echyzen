<?php

namespace Echyzen\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\NewsBundle\Entity\NewsRepository")
 * @ORM\Table(name="news")
 */
class News
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="rubrique", type="string", length=255)
     */
    private $rubrique;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;
	
	/**
	* @ORM\Column(name="publication", type="boolean")
	*/
	private $publication;

    /**
    * @ORM\OneToOne(targetEntity="Echyzen\NewsBundle\Entity\Image", cascade={"persist", "remove"})
    */
    private $image;

    /**
    * @ORM\ManyToOne(targetEntity="Echyzen\NewsBundle\Entity\Rubrique", inversedBy="news")
    */
    private $rubrique;

    /**
    * @ORM\OneToMany(targetEntity="Echyzen\NewsBundle\Entity\Commentaire", mappedBy="article")
    */
    private $commentaires;

	public function __construct()
	{
		$this->date = new \Datetime(); // Par défaut, la date de l'article est la date d'aujourd'hui
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection(); // C'est un arrayCollection, il doit donc être initialisé
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
     * Set date
     *
     * @param \DateTime $date
     * @return News
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
     * Set rubrique
     *
     * @param string $rubrique
     * @return News
     */
    public function setRubrique($rubrique)
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    /**
     * Get rubrique
     *
     * @return string 
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return News
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return News
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
     * Set publication
     *
     * @param boolean $publication
     * @return News
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Add commentaires
     *
     * @param \Echyzen\NewsBundle\Entity\Commentaire $commentaires
     * @return News
     */
    public function addCommentaire(\Echyzen\NewsBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \Echyzen\NewsBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\Echyzen\NewsBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}

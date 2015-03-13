<?php

namespace Echyzen\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\TestBundle\Entity\FilmRepository")
 *
 * @ORM\Table(name="film")
 */
class Film extends Test
{

    /**
     * @var string
     *
     * @ORM\Column(name="realisateur", type="string", length=255)
     */
    private $realisateur;

	/**
     * @var string
     *
     * @ORM\Column(name="production", type="string", length=255)
     */
    private $production;
	
	/**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duree", type="datetime")
     */
    private $duree;



    /**
     * Set realisateur
     *
     * @param string $realisateur
     * @return Film
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    /**
     * Get realisateur
     *
     * @return string 
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * Set production
     *
     * @param string $production
     * @return Film
     */
    public function setProduction($production)
    {
        $this->production = $production;

        return $this;
    }

    /**
     * Get production
     *
     * @return string 
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Film
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }



    /**
     * Set duree
     *
     * @param \DateTime $duree
     * @return Film
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return \DateTime 
     */
    public function getDuree()
    {
        return $this->duree;
    }
}

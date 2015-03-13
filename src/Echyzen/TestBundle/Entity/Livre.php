<?php

namespace Echyzen\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Livre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\TestBundle\Entity\LivreRepository")
 *
 * @ORM\Table(name="livre")
 */
class Livre extends Test
{

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

	/**
     * @var string
     *
     * @ORM\Column(name="edition", type="string", length=255)
     */
    private $edition;
	
	/**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;




    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Livre
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
     * Set edition
     *
     * @param string $edition
     * @return Livre
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return string 
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Livre
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

}

<?php

namespace Echyzen\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\TestBundle\Entity\GameRepository")
 *
 * @ORM\Table(name="game")
 */
class Game extends Test
{

    /**
     * @var string
     *
     * @ORM\Column(name="editeur", type="string", length=255)
     */
    private $editeur;

    /**
     * @var string
     *
     * @ORM\Column(name="developpeur", type="string", length=255)
     */
    private $developpeur;

    /**
     * @var string
     *
     * @ORM\Column(name="plateforme", type="string", length=255)
     */
    private $plateforme;

    /**
     * Set editeur
     *
     * @param string $editeur
     * @return Game
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return string 
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set developpeur
     *
     * @param string $developpeur
     * @return Game
     */
    public function setDeveloppeur($developpeur)
    {
        $this->developpeur = $developpeur;

        return $this;
    }

    /**
     * Get developpeur
     *
     * @return string 
     */
    public function getDeveloppeur()
    {
        return $this->developpeur;
    }

    /**
     * Set plateforme
     *
     * @param string $plateforme
     * @return Game
     */
    public function setPlateforme($plateforme)
    {
        $this->plateforme = $plateforme;

        return $this;
    }

    /**
     * Get plateforme
     *
     * @return string 
     */
    public function getPlateforme()
    {
        return $this->plateforme;
    }
}

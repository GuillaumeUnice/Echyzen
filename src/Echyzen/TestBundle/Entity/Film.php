<?php

namespace Echyzen\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\NewsBundle\Entity\FilmRepository")
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



}

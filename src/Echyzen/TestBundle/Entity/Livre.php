<?php

namespace Echyzen\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Echyzen\NewsBundle\Entity\FilmRepository")

 * @ORM\Table(name="film")
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



}

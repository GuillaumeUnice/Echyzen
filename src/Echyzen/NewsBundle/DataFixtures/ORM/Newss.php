<?php
// src/Sdz/UserBundle/DataFixtures/ORM/Newss.php

namespace Echyzen\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Echyzen\NewsBundle\Entity\News;

class Newss implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
      // On crée la news
      $news = new News;

      $news->setPublication(true);


      $contenu = "Salut,
à tous voilà enfin la première news pour dire que les news sont en place cela prouve la nécessité de cette dernière non? (On comprend rien ce que tu raconte !!!)

Ok, j'arrête avec les trucs compliqués. Juste pour dire que c'est la première news et qu'il en aura bien d'autre j'espère. Ce module permettra donc de poster les nouveauté du site mais pas que, je donnerais mes découvertes pertinentes,ainsi que l'ouverture ou clôture de l'un de mes projet...

Je vais tenter de mettre en place un système de commentaire de news car sinon c'est pas drôle XD
Non, car via cela je peut communiquer facilement mais je pense qu'il faudrait faire de même pour vous donc dans un premier temps de simple commentaire après tout dépend comment cela va évoluer...

Sur ce bonne journée ou soirée (ou même mâtiné pour nos amis canadien :D)

Votre serviteur Echyzen";

      $news->setContenu($contenu);

      $titre = "News pour News";

      $news->setTitre($titre);

      // On le persiste
      $manager->persist($news);
    

    // On déclenche l'enregistrement
    $manager->flush();
  }
}
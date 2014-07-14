<?php

namespace Echyzen\NewsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends EntityRepository
{
	public function getByRubrique($id) {
		return $this->createQueryBuilder('n')->where('n.rubrique = :id')->setParameter('id', $id)->orderBy('n.date')->getQuery()->getResult();
	}
}

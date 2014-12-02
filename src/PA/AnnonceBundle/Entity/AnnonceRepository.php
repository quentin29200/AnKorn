<?php

namespace PA\AnnonceBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnonceRepository extends EntityRepository
{
	public function recupannoncesoffre()
	{
		$qb = $this->createQueryBuilder('a');
 		$qb
   			->where('a.an_dateSupression IS NULL')
        ->andWhere('a.an_publie = true')
        ->andWhere("a.an_type = 'offre'")
    		->orderBy('a.an_datePublication', 'DESC')
  		;

  		return $qb
   			->getQuery()
    		->getResult()
  		;
	}
  public function recupannoncesdemande()
  {
    $qb = $this->createQueryBuilder('a');
    $qb
        ->where('a.an_dateSupression IS NULL')
        ->andWhere('a.an_publie = true')
        ->andWhere("a.an_type = 'demande'")
        ->orderBy('a.an_datePublication', 'DESC')
      ;

      return $qb
        ->getQuery()
        ->getResult()
      ;
  }
  public function recupannonces()
  {
    $qb = $this->createQueryBuilder('a');
    $qb
        ->where('a.an_dateSupression IS NULL')
        ->andWhere('a.an_publie = true')
        ->orderBy('a.an_datePublication', 'DESC')
      ;

      return $qb
        ->getQuery()
        ->getResult()
      ;
  }
}

<?php

namespace PA\AnnonceBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

  public function recupmesannonces($id)
  {
    $qb = $this->createQueryBuilder('a');
    $qb
        ->where('a.an_dateSupression IS NULL')
        ->andWhere('a.an_user = :user')
        ->setParameter('user', $id)
        ->orderBy('a.an_datePublication', 'DESC')
      ;

      return $qb
        ->getQuery()
        ->getResult()
      ;
  }

  public function recupannonce($id)
  {
    $qb = $this->createQueryBuilder('a');
    $qb
        ->where('a.an_dateSupression IS NULL')
        ->andWhere('a.an_id = :annonceid')
        ->setParameter('annonceid', $id)
      ;

      return $qb
        ->getQuery()
        ->getSingleResult()
      ;
  }

  /**
     * Compte le nombre de lignes 
     * @param array $options
     * @return integer
     */
  public function countann(array $options = null) {
        $qb = $this->createQueryBuilder('a');
        $qb->select('count(a)');
        if ($options != null) {
            foreach ($options as $option => $valeur) {
                if (!empty($valeur)) {
                  if ($option == "an_titre") {
                    $qb->andWhere("a.". $option . " LIKE '%" . $valeur . "%'");
                  } else if ($option == "an_secteur") {
                      foreach ($valeur as $secteur) {
                         $qb->andWhere("a.". $option . ' = ' . $secteur);
                      }
                  } else if ($option == "an_type") {
                    $qb->andWhere("a.". $option . " = '" . $valeur . "'"); 
                  } else {
                    $qb->andWhere("a.". $option . ' = ' . $valeur );
                  }
                }
            }
        }
        return $qb->getQuery()->getSingleResult();
  }

  public function pagination($maxResults, $page = 1, $sort = null, $order = null,array $options = null) {
        $qb = $this->createQueryBuilder('a');
        if ($options != null) {
            foreach ($options as $option => $valeur) {
                if (!empty($valeur)) {
                  if ($option == "an_titre") {
                    $qb->andWhere("a.". $option . " LIKE '%" . $valeur . "%'");
                  } else if ($option == "an_secteur") {
                      foreach ($valeur as $secteur) {
                         $qb->andWhere("a.". $option . ' = ' . $secteur);
                      }
                  } else if ($option == "an_type") {
                    $qb->andWhere("a.". $option . " = '" . $valeur . "'"); 
                  } else {
                    $qb->andWhere("a.". $option . ' = ' . $valeur );
                  }
                }
            }
        }
        if ($sort != null) $qb->orderBy("a.". $sort, $order);
        $query = $qb->getQuery();
        $query->setFirstResult(($page - 1) * $maxResults)
                ->setMaxResults($maxResults);
        return $query->getResult();
  }

  /*public function searchannonces($page, $nom, $sect, $type, $cat)
  {
    $qbnom = '';
    $qbsect = '';
    $qbtype = '';
    $qbcat = '';

    $qbtotal = 'a.an_dateSupression IS NULL AND a.an_publie = true';

    if (!is_null($nom)) {
           $qbtotal .= " AND a.an_titre LIKE '%".$nom."%'";
    }

    if (!empty($sect)) {
            $first = true;
            foreach ($sect as $secteur) {
                if ($first) {
                    $qbtotal .= ' AND ';
                    $first = false;
                } else {
                     $qbtotal .= ' OR ';
                }
                   $qbtotal .= " a.an_secteur = '" .$secteur."'";
            }
    }

    if (!is_null($type)) {
           $qbtotal .= " AND a.an_type = '" .$type."'"; 
    }
    if (!is_null($cat)) {
           $qbtotal .= ' AND a.an_categorie = ' .$cat;
    }

    $qb = $this->createQueryBuilder('a');
    $qb
        ->select('a')
        ->where($qbtotal)
        ->orderBy('a.an_datePublication', 'DESC')
        ->setFirstResult(($page-1) * 21)
        ->setMaxResults(21)
      ;
 
    return new Paginator($qb);
  }*/
}

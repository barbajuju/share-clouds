<?php

namespace App\Repository;

use App\Entity\Picture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Picture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture[]    findAll()
 * @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureRepository extends ServiceEntityRepository
{
    public function search(?string $q = null)
    {
        //version DQL
        //$dql = "SELECT m FROM App\Entity\Movie m WHERE m.title LIKE :q OR m.actors LIKE :q OR m.directors LIKE :q";

        //version QueryBuilder
        $qb = $this->createQueryBuilder('m');
        if (!empty('q')) {
            $qb->andWhere('m.title LIKE :q OR m.actors LIKE :q OR m.directors LIKE :q');
            $qb->setParameter("q", '%' . $q . '%');
        }
        $qb->addOrderBy("m.rating", "DESC");

        //ceci permet de ne faire qu'une seule requete pour aller chercher l'ensemble des films : c'est une jointure
        //leftJoin : permet de selectionner les films qui ont des reviews
        //          et si pas de review selectione des films en quantité parametré
        $qb->leftJoin('m.reviews', 'r');
        $qb->addSelect('r');

        $query = $qb->getQuery();

        //version DQL
        //$query = $this->getEntityManager()->createQuery($dql);
        //$query->setParameter("q", '%' . $q . '%'); commenté depuis la modif pour eviter les 50 requetes et remonté dans le if
        $query->setMaxResults(30);
        $results = $query->getResult();

        return $results;
    }

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Picture::class);
    }

//    /**
//     * @return Picture[] Returns an array of Picture objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Picture
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    //En fait, le repository permet les requêtes select (les 4 au dessus + celles qu'on va créer comme la findValid). 
    //C'est utile si on veut faire un select plus complexe, avec des where, des order, ce genre de choses
    public function findValid(){
        $qb = $this
            ->creatQueryBuilder('p') //dans la parenthèse, c'est un alias
            ->where('p.publishedAt <= :now') //le :now c'est un paramètre
            ->setParameter('now', new \DateTime()); //on lui dit donc que le now est un DateTime

            return $qb->getQuery()->getResult();

    }

    public function findContentLike(){

        $qb = $this

        ->creatQueryBuilder('p') 
        ->where('p.content LIKE %:content%') 
        ->setParameter('now', $content); 

        return $qb->getQuery()->getResult();

    }

    public function finfValidByCategory(Category $category){
        $qb = $this
        ->creatQueryBuilder('p') //dans la parenthèse, c'est un alias
        ->join('p.categories', 'c')
        ->where('p.publishedAt <= :now') //le :now c'est un paramètre
        ->andWhere('c.id = :id')
        ->setParameter('now', new \DateTime()) //on lui dit donc que le now est un DateTime
        ->setParameter('id', $category->getId()); //on récupère l'id de la catégorie en question
//On aurait aussi pu faire un $qb=$this->FindValid()->join->andWhere->setParameter..
        return $qb->getQuery()->getResult();

    }
    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
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
    public function findOneBySomeField($value): ?Post
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

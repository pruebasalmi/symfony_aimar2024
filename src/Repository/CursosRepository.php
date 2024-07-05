<?php

namespace App\Repository;

use App\Entity\Cursos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cursos>
 *
 * @method Cursos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cursos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cursos[]    findAll()
 * @method Cursos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cursos::class);
    }

//    /**
//     * @return Cursos[] Returns an array of Cursos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cursos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    private function add(Cursos $cursos, bool $flush): void
    {
        $this->getEntityManager()->persist($cursos);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    private function remove(Coche $cursos, bool $flush): void
    {
        $this->getEntityManager()->remove($cursos);
        if ($flush) {
            $this->getEntityManager()->flush();

        }
    }
}


<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 *
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly Connection $employeeConnection

    )
    {
        parent::__construct($registry, Employee::class);
    }

    public function save(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function upsert(array $employees, array $types, array $keysToUpdate)
    {
        $this->employeeConnection->upsert(
            'employee',
            $employees,
            $types,
            $keysToUpdate
        );
    }


//    /**
//     * @return Employee[] Returns an array of Employee objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findOneByEmployeeId($employeeId): ?Employee
    {
        return $this->getEntityManager()->getRepository(Employee::class)
            ->findOneBy(['employee_id'=>$employeeId])
        ;
    }
}

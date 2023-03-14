<?php

declare(strict_types=1);

namespace App\Controller;

use App\Action\AddEmployeesToDatabaseAction;
use App\Entity\Employee;
use App\Queues\Message\UpsertCsvIntoDatabase;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use SplFileObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api', name: 'api_')]
final class EmployeeController extends AbstractController
{

    public function __construct(
        private readonly Filesystem $filesystem,
        private readonly string $resourcesPath,
        private readonly MessageBusInterface $messageBus,
        private readonly EntityManagerInterface $entityManager,
        private readonly EmployeeRepository $employeeRepository
    ) {
    }

    #[Route('/employee', name: 'employee', methods: Request::METHOD_GET)]
    public function index(): JsonResponse
    {
        $employees = array_map(fn($employee) => (object) $employee->toArray(), $this->entityManager->getRepository(Employee::class)->findAll());
        return $this->json(
            $employees,
        );
    }

    #[Route('/employee/{employeeId}', name: 'employee', methods: Request::METHOD_GET)]
    public function show(int $employeeId): JsonResponse
    {
        $employee = $this->employeeRepository->findOneByEmployeeId($employeeId);

        if (!$employee) {
            return $this->json([
                'message'=> 'Cannot Find The given employee Id',
            ]);
        }

        return $this->json(
            $employee->toArray()
        );
    }

    #[Route('/employee', name: 'employee_store', methods: Request::METHOD_POST)]
    public function store(Request $request): JsonResponse
    {
      $this->filesystem->dumpFile($this->resourcesPath.'employee.csv', $request->getContent());

      $this->messageBus->dispatch(new UpsertCsvIntoDatabase());

        return $this->json([
            'message'=> 'Csv Inserted Successfully',
        ]);
    }

    #[Route('/employee/{employeeId}', name: 'employee_delete', methods: Request::METHOD_DELETE)]
    public function delete(int $employeeId): JsonResponse
    {
        $employee = $this->entityManager->getRepository(Employee::class)
            ->findOneBy(['employee_id'=>$employeeId])
        ;

        if (!$employee) {
            return $this->json([
                'message'=> 'Cannot Find The given employee Id',
            ]);
        }

        $this->entityManager->remove($employee);
        $this->entityManager->flush();

        return $this->json([
            'message'=> 'Employee Deleted Successfully',
        ]);
    }
}

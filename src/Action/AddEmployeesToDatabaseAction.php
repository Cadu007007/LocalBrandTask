<?php

declare(strict_types=1);

namespace App\Action;

use App\Persistence\EmployeeMapper;
use App\Repository\EmployeeRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use SplFileObject;

final class AddEmployeesToDatabaseAction
{

    public function __construct(
        private readonly GetCsvDataAction $getCsvDataAction,
        private readonly EmployeeMapper $employeeMapper,
        private readonly EmployeeRepository $employeeRepository
    ) {
    }

    public function __invoke(): void
    {

        $csvFile = ($this->getCsvDataAction)();

        $batchSize = 50;
        $iterator = 0;
        $employees=[];

        while (!$csvFile->eof()) {

            $employee = $csvFile->fgetcsv();

            // if it's empty line insert and continue
            if(!$employee){
                continue;
            }
            // make csv data associative array
            $csvEmployee = array_combine($this->getColumnsKeys(), $employee);

            if(!$csvEmployee['employee_id']) {
                continue;
            }

            // map keys to match types in db
            $employees[] = $this->employeeMapper->mapToDatabase($csvEmployee);

            // insert 50 by 50
           if($iterator == $batchSize) {

               $this->employeeRepository->upsert(
                   $employees,
                   $this->getColumnsTypes(),
                   $this->getColumnsKeys()
               );

               $employees = [];
               $iterator = 0;
           }

            $iterator++;
        }

        $this->employeeRepository->upsert(
            $employees,
            $this->getColumnsTypes(),
            $this->getColumnsKeys()
        );
    }

    private function getColumnsKeys(): array
    {
        return [
            'employee_id',
            'name_prefix',
            'first_name',
            'middle_initial',
            'last_name',
            'gender',
            'email',
            'birth_date',
            'birth_time',
            'age_years',
            'joining_date',
            'age_in_company',
            'phone',
            'place_name',
            'country',
            'city',
            'zip',
            'region',
            'user_name'
        ];
    }

    private function getColumnsTypes(): array
    {
        return [
            Types::INTEGER,
            Types::STRING,
            Types::STRING,
            Types::STRING,
            Types::STRING,
            Types::BOOLEAN,
            Types::STRING,
            Types::DATE_IMMUTABLE,
            Types::TIME_IMMUTABLE,
            Types::FLOAT,
            Types::DATE_MUTABLE,
            Types::FLOAT,
            Types::STRING,
            Types::STRING,
            Types::STRING,
            Types::STRING,
            Types::INTEGER,
            Types::STRING,
            Types::STRING,
        ];
    }
}
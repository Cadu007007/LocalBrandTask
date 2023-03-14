<?php

declare(strict_types=1);

namespace App\Persistence;

use Doctrine\DBAL\Types\Types;

final class EmployeeMapper
{
    public function mapToDatabase(array $employee): array
    {
        $employee['gender'] = ($employee['gender'] == 'M');

        $birthDate = \DateTimeImmutable::createFromFormat('m/d/yy', $employee['birth_date']);
        $employee['birth_date'] = ($birthDate) ? $birthDate : null;

        $birthTime = \DateTimeImmutable::createFromFormat('h:i:s a', $employee['birth_time']);
        $employee['birth_time'] =  ($birthTime)? $birthTime: null;

        $joiningDate = \DateTimeImmutable::createFromFormat('m/d/yy', $employee['joining_date']);
        $employee['joining_date'] = ($joiningDate) ? $joiningDate : null;

        $employee['age_in_company'] = (float) $employee['age_in_company'];

        return $employee;
    }

}
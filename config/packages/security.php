<?php

declare(strict_types=1);

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Config\SecurityConfig;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

return static function (SecurityConfig $security) {
    $security
        ->enableAuthenticatorManager(true)
        ->passwordHasher(PasswordAuthenticatedUserInterface::class)
        ->algorithm('plaintext')
    ;

    $security->provider('employee_basic_auth')
        ->memory()
        ->user((string) env('EMPLOYEE_USERNAME'))
        ->password((string) env('EMPLOYEE_PASSWORD'))
        ->roles(['ROLE_EMPLOYEE_USER'])
    ;

    $security->firewall('employee_firewall')
        ->httpBasic()
        ->realm('Secured Area')
        ->provider('employee_basic_auth')
    ;

    $security->accessControl()
        ->path('^/api/employee')
        ->roles(['ROLE_EMPLOYEE_USER'])
    ;
};

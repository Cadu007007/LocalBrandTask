<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $user_name = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $name_prefix;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_name;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $middle_initial;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $last_name;

    #[ORM\Column(nullable: true)]
    private ?bool $gender;

    #[ORM\Column(length: 255,nullable: true)]
    private string $email;

    #[ORM\Column(type: Types::DATE_MUTABLE,nullable: true)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE,nullable: true)]
    private ?\DateTimeInterface $birth_time = null;

    #[ORM\Column(nullable: true)]
    private ?float $age_years;

    #[ORM\Column(type: Types::DATE_MUTABLE,nullable: true)]
    private ?\DateTimeInterface $joining_date;

    #[ORM\Column(nullable: true)]
    private ?float $age_in_company;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $phone;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $place_name;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $country;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $city;

    #[ORM\Column(nullable: true)]
    private ?int $zip;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $region;

    #[ORM\Column(unique:true)]
    private int $employee_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getNamePrefix(): ?string
    {
        return $this->name_prefix;
    }

    public function setNamePrefix(string $name_prefix): self
    {
        $this->name_prefix = $name_prefix;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getMiddleInitial(): ?string
    {
        return $this->middle_initial;
    }

    public function setMiddleInitial(string $middle_initial): self
    {
        $this->middle_initial = $middle_initial;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function isGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getBirthTime(): ?\DateTimeInterface
    {
        return $this->birth_time;
    }

    public function setBirthTime(\DateTimeInterface $birth_time): self
    {
        $this->birth_time = $birth_time;

        return $this;
    }

    public function getAgeYears(): ?float
    {
        return $this->age_years;
    }

    public function setAgeYears(float $age_years): self
    {
        $this->age_years = $age_years;

        return $this;
    }

    public function getJoiningDate(): ?\DateTimeInterface
    {
        return $this->joining_date;
    }

    public function setJoiningDate(\DateTimeInterface $joining_date): self
    {
        $this->joining_date = $joining_date;

        return $this;
    }

    public function getAgeInCompany(): ?float
    {
        return $this->age_in_company;
    }

    public function setAgeInCompany(float $age_in_company): self
    {
        $this->age_in_company = $age_in_company;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPlaceName(): ?string
    {
        return $this->place_name;
    }

    public function setPlaceName(string $place_name): self
    {
        $this->place_name = $place_name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZip(): ?int
    {
        return $this->zip;
    }

    public function setZip(int $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getEmployeeId(): ?int
    {
        return $this->employee_id;
    }

    public function setEmployeeId(int $employee_id): self
    {
        $this->employee_id = $employee_id;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'employee_id' => $this->employee_id,
            'name_prefix' => $this->name_prefix,
            'first_name' => $this->first_name,
            'middle_initial' => $this->middle_initial,
            'last_name' => $this->last_name,
            'gender' => $this->gender ? 'Male' : 'Female',
            'email' => $this->email,
            'birth_date' => $this->birth_date?->format('d-m-Y'),
            'birth_time' => $this->birth_time?->format('H:i:s A') ,
            'age_years' => $this->age_years,
            'joining_date' => $this->joining_date?->format('d-m-Y') ,
            'age_in_company' => $this->age_in_company ,
            'phone' => $this->phone,
            'place_name' => $this->place_name,
            'country' => $this->country,
            'city' => $this->city,
            'zip' => $this->zip,
            'region' => $this->region,
            'user_name' => $this->user_name
        ];
    }
}

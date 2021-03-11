<?php

declare(strict_types=1);

namespace Eagle\Module\User\Domain\Model;

class User
{
    private string $username;

    private string $password;

    private string $email;

    private array $roles;

    private bool $isActive;

    public function __construct(
        string $username,
        string $email,
        string $password,
        array $roles = ['user'],
        bool $isActive = true
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->isActive = $isActive;
    }

    public function username(): ?string
    {
        return $this->username;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function roles(): array
    {
        return $this->roles;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
}
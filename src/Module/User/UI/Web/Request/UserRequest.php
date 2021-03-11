<?php

declare(strict_types=1);

namespace Eagle\Module\User\UI\Web\Request;

use Eagle\Module\User\Domain\Model\User;
use Symfony\Component\Validator\Constraints as Assert;

class UserRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="100")
     * @var string
     */
    public string $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="100")
     * @var string
     */
    public string $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="100")
     * @var string
     */
    public string $email;

    /**
     * @var bool
     */
    public bool $isActive;

    public static function from(User $user): self
    {
        $userRequest = new self();
        $userRequest->username = $user->username();
        $userRequest->email = $user->email();
        $userRequest->password = $user->password();
        $userRequest->isActive = $user->isActive();

        return $userRequest;
    }
}
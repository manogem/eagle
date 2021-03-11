<?php

declare(strict_types=1);

namespace Eagle\Module\User\Infrastructure\Write;

use Eagle\Module\User\Domain\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Eagle\Module\User\Application\Write\UserWriteRepositoryInterface;
use Eagle\Module\User\Infrastructure\Entity\User as UserEntity;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DoctrineUserWriteRepository implements UserWriteRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    private UserPasswordEncoderInterface $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
    }

    public function save(User $user): void
    {
        $userEntity = new UserEntity();
        $userEntity->setPassword($this->encoder->encodePassword($userEntity, $user->password()));
        $userEntity->setEmail($user->email());
        $userEntity->setUsername($user->username());

        $this->entityManager->persist($userEntity);
    }
}
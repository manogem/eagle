<?php

declare(strict_types=1);

namespace Eagle\Doctrine;

use Doctrine\Persistence\ObjectManager;
use Gesdinet\JWTRefreshTokenBundle\Doctrine\RefreshTokenManager as BaseRefreshTokenManager;

# workaround for broken library ToDO: update when fixed
class RefreshTokenManager extends BaseRefreshTokenManager
{
    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);
        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }
}
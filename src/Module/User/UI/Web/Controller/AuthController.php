<?php

declare(strict_types=1);

namespace Eagle\Module\User\UI\Web\Controller;

use Eagle\Module\Common\Application\MessageHandler\CommandBus;
use Eagle\Module\Common\UI\Web\Controller\ApiController;
use Eagle\Module\User\Domain\Model\User;
use Eagle\Module\User\UI\Web\Form\UserForm;
use Eagle\Module\User\UI\Web\Request\UserRequest;
use Eagle\Module\User\Application\Command\SaveUserCommand;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends ApiController
{
    private CommandBus $commandBus;

    private LoggerInterface $logger;

    public function __construct(CommandBus $commandBus, LoggerInterface $logger)
    {
        $this->commandBus = $commandBus;
        $this->logger = $logger;
    }

    public function register(Request $request)
    {
        $userRequest = new UserRequest();

        $form = $this->createForm(UserForm::class, $userRequest);
        $form->submit($this->getJsonBody($request));

        if ($form->isValid()) {
            $this->commandBus->run(
                new SaveUserCommand(
                    new User(
                        $form->getData()->username,
                        $form->getData()->email,
                        $form->getData()->password
                    )
                )
            );

            return $this->respond(Response::HTTP_CREATED);
        }

        return $this->respondWithErrors(Response::HTTP_BAD_REQUEST, $this->getFormErrors($form));
    }

    public function getTokenUser()
    {
        return $this->respondWithErrors(Response::HTTP_BAD_REQUEST, ['body' => 'missing']);
    }
}
<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class ApiController extends AbstractController
{
    protected function metadata(int $totalCount): array
    {
        return [
            'totalCount' => $totalCount
        ];
    }

    protected function respond(int $status): JsonResponse
    {
        return new JsonResponse(null, $status);
    }

    protected function respondWithErrors(int $status, array $errors, array $headers = []): JsonResponse
    {
        $data = [
            'errors' => $errors,
        ];

        return new JsonResponse($data, $status, $headers);
    }

    protected function respondWithData(int $status, array $data, array $metadata = [], array $headers = []): JsonResponse
    {
        $data = [
            'data' => $data,
            'metadata' => $metadata
        ];

        return new JsonResponse($data, $status, $headers);
    }

    protected function getJsonBody(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }

    protected function getFormErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getFormErrors($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}
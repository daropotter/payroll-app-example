<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Symfony;

use DigitalRevolution\SymfonyRequestValidation\InvalidRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class InvalidRequestExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if (!$exception instanceof InvalidRequestException) {
            return;
        }

        $response = new JsonResponse();
        $response->setContent(json_encode(['error' => $exception->getMessage()]));
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $event->setResponse($response);
    }
}

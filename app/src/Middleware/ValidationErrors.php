<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Spiral\Filters\Exception\ValidationException;

class ValidationErrors implements MiddlewareInterface
{
    public function __construct(private ResponseFactoryInterface $factory)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ValidationException $e) {
            return $this->factory->createResponse(
                422,
                json_encode([
                    'message' => $e->getMessage(),
                    'errors' => $e->getErrors(),
                ])
            );
        }
    }
}

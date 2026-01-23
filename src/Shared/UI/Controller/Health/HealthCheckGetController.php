<?php

declare(strict_types=1);

namespace ApiRol\Shared\UI\Controller\Health;

use ApiRol\Shared\UI\Controller\ApiController;
use ApiRol\Shared\UI\Response\ApiHttpResponse;

final class HealthCheckGetController extends ApiController
{
    public function __invoke(): ApiHttpResponse
    {
        return new ApiHttpResponse(['status' => 'Service Available']);
    }
}

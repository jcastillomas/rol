<?php

declare(strict_types=1);

namespace ApiRol\Shared\UI\Response;

final class ResourceAcceptedHttpResponse extends ApiHttpResponse
{
    public function __construct()
    {
        parent::__construct([], HttpResponseCode::HTTP_ACCEPTED);
    }
}

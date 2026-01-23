<?php

declare(strict_types=1);

namespace ApiRol\Shared\UI\Response;

use ApiRol\Shared\Application\Bus\Query\Response;

abstract class HttpResponseTransformer
{
    private const DATA = 'data';
    private const METADATA = 'metadata';

    abstract protected function transformData(Response $queryResponse): array;

    abstract protected function transformMetadata(Response $queryResponse): array;

    public function transform(Response $queryResponse): array
    {
        return [self::DATA => $this->transformData($queryResponse), self::METADATA => $this->transformMetadata($queryResponse)];
    }
}

<?php

declare(strict_types=1);

namespace ApiRol\Shared\Application\Bus\Query;

interface Response
{
    public function result(): array;
}

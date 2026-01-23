<?php

declare(strict_types=1);

namespace ApiRol\Shared\Application\Bus\Command;

interface Response
{
    public function result(): array;
}

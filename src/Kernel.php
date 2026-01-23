<?php

namespace ApiRol;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use ApiRol\Shared\Infrastructure\Symfony\DependencyInjection\Compiler\MessageFactoryCompilerPass;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new MessageFactoryCompilerPass());
    }
}

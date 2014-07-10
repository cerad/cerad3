<?php

namespace Cerad\Bundle\Api01Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Cerad\Bundle\Api01Bundle\DependencyInjection\Compiler\Pass;

class CeradApi01Bundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new Pass());
    }
}

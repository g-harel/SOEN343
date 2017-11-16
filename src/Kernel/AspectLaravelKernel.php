<?php
/*
 * Go! AOP framework
 *
 * @copyright Copyright 2016, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Go\Laravel\GoAopBridge\Kernel;

use Go\Core\AspectContainer;
use Go\Core\AspectKernel;
use Aspect\UoWAspect;

/**
 * Laravel aspect kernel class
 */
class AspectLaravelKernel extends AspectKernel
{
    /**
     * {@inheritdoc}
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new UoWAspect());
    }
}

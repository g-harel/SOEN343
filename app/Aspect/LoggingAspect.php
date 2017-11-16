<?php

namespace App\Aspect;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Psr\Log\LoggerInterface;

/**
 * Application UoW aspect
 */
class UoWAspect implements Aspect
{
    /**
     * Executes save() method that goes from UoW to the Mapper after method execution
     *
     * @param MethodInvocation $invocation
     * @After("execution(public **->*(*))")
     */
    public function afterMethod(MethodInvocation $invocation)
    {
        $this->logger->info($invocation, $invocation->getArguments());
    }
}
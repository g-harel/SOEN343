<?php
declare(strict_types = 1);
/*
 * Go! AOP framework
 */

namespace App\Aspect;

use App\UnitOfWork\UnitOfWork;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Pointcut;
use Go\Core\AspectContainer;
use Go\Core\AspectKernel;
use Go\Lang\Annotation\DeclareParents;
/**
 * Aspect of Unit of Work
 */
class UoWAspect implements Aspect
{
    /**
     * Method that activates the UoW after committing to Mapper
     *
     * @param MethodInvocation $invocation
     * @Before("execution(public App\Mappers\*->commit(*))")
     */
    protected function SaveAfterCommit(MethodInvocation $invocation)
    {
        $transactionId = $invocation->getArguments()[0];
        $UnitOfWork = UnitOfWork::getInstance();
        $UnitOfWork->commit($transactionId);
    }
}
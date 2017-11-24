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
    protected function commit(MethodInvocation $invocation)
    {
        $transactionId = $invocation->getArguments()[0];
        $unitOfWork = UnitOfWork::getInstance();
        $unitOfWork->commit($transactionId);
    }

    /**
     * Method that activates the UoW after committing to Mapper
     *
     * @param MethodInvocation $invocation
     * @Before("execution(public App\Mappers\*->registerDirty(*))")
     */
    protected function registerDirty(MethodInvocation $invocation)
    {
        $transactionId = $invocation->getArguments()[0];
        $objectId = $invocation->getArguments()[1];
        $mapper = $invocation->getArguments()[2];
        $object = $invocation->getArguments()[3];
        $unitOfWork = UnitOfWork::getInstance();
        $unitOfWork->registerDirty($transactionId, $objectId, $mapper, $object);
    }

    /**
     * Method that activates the UoW after committing to Mapper
     *
     * @param MethodInvocation $invocation
     * @Before("execution(public App\Mappers\*->registerNew(*))")
     */
    protected function registerNew(MethodInvocation $invocation)
    {
        $transactionId = $invocation->getArguments()[0];
        $mapper = $invocation->getArguments()[1];
        $object = $invocation->getArguments()[2];
        $unitOfWork = UnitOfWork::getInstance();
        $unitOfWork->registerNew($transactionId, $mapper, $object);
    }

    /**
     * Method that activates the UoW after committing to Mapper
     *
     * @param MethodInvocation $invocation
     * @Before("execution(public App\Mappers\*->registerDeleted(*))")
     */
    protected function registerDeleted(MethodInvocation $invocation)
    {
        $transactionId = $invocation->getArguments()[0];
        $objectId = $invocation->getArguments()[1];
        $mapper = $invocation->getArguments()[2];
        $object = $invocation->getArguments()[3];
        $unitOfWork = UnitOfWork::getInstance();
        $unitOfWork->registerDeleted($transactionId, $objectId, $mapper, $object);
    }
}
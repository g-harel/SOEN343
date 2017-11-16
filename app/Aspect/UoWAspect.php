<?php
declare(strict_types = 1);
/*
 * Go! AOP framework
 */
include("UnitOfWork.php");
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Pointcut;
use Go\Core\AspectContainer;
use Go\Core\AspectKernel;
/**
 * Aspect of Unit of Work
 */
class UoWAspect implements Aspect
{

    /**
     * Pointcut for commit method
     *
     * @Pointcut("execution(public mappers\ItemCatalogMappers->commit(*))")
     */
    protected function commit() {}


    /**
     * Method that activates the UoW after committing to Mapper
     *
     * @param MethodInvocation $invocation
     * @After("$this->commit()")
     */
    protected function SaveAfterCommit(MethodInvocation $invocation)
    {
        $UnitOfWork = new UnitOfWork();
        $transactionId = $invocation->getThis();
        $transactionId -> $UnitOfWork -> commit();
    }
}
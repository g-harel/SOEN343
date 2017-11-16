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
     * @After("execution(public ItemCatalogMappers->commit(*))") // This is our PointCut
     */
    protected function SaveAfterCommit(MethodInvocation $invocation)
    {
        $UnitOfWork = new UnitOfWork();
        $transactionId = $invocation->getThis();
        $transactionId -> $UnitOfWork -> commit();
    }
}
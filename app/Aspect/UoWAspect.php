<?php
declare(strict_types = 1);
/*
 * Go! AOP framework
 */
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
     * Method that advices to activate the UoW after committing to Mapper
     * Pointcut for eat method
     *
     * @Pointcut("execution(public mappers\ItemCatalogMappers->commit(*))")
     * @param MethodInvocation $invocation Invocation
     * @After("execution(public **->*(*))")
     */
    protected function SaveAfterCommit(MethodInvocation $invocation)
    {
        $this->
    }
}
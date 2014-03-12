<?php

namespace Saxulum\Tests\AnnotationManager\Classes1;

use Saxulum\Tests\AnnotationManager\Annotation as Test;

/**
 * @Test\TestAnnotationA("test1")
 */
class TestClass1
{
    /**
     * @Test\TestAnnotationB(false)
     */
    protected $test;

    /**
     * @Test\TestAnnotationA("test1")
     * @Test\TestAnnotationB(true)
     */
    public function test1()
    {

    }

    /**
     * @Test\TestAnnotationB(true)
     */
    public function test2()
    {

    }

    public function test3()
    {

    }
}

<?php

namespace Saxulum\Tests\AnnotationManager\Annotation;

/**
 * @Annotation
 * @Target({"METHOD","PROPERTY"})
 */
class TestAnnotationB
{
    /**
     * @var boolean
     */
    public $value = false;
}

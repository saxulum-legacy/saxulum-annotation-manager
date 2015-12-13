<?php

namespace Saxulum\Tests\AnnotationManager\Annotation;

/**
 * @Annotation
 * @Target({"CLASS","METHOD"})
 */
class TestAnnotationA
{
    /**
     * @var string
     */
    public $value = '';
}

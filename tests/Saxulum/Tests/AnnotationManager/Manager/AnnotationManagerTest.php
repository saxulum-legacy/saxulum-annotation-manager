<?php

namespace Saxulum\Tests\AnnotationManager\Manager;

use Doctrine\Common\Annotations\AnnotationReader;
use Saxulum\AnnotationManager\Helper\ClassInfo;
use Saxulum\AnnotationManager\Manager\AnnotationManager;
use Saxulum\Tests\AnnotationManager\Classes1\TestClass1;
use Saxulum\Tests\AnnotationManager\Classes1\TestClass2;

class AnnotationManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildClassInfosBasedOnPaths()
    {
        $annotationReader = new AnnotationReader();
        $annotationManager = new AnnotationManager($annotationReader);

        $classInfos = $annotationManager->buildClassInfosBasedOnPaths(array(
            dirname(__DIR__) . '/Classes1',
            dirname(__DIR__) . '/Classes2'
        ));

        $this->assertCount(3, $classInfos);
        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfos[0]);
        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfos[1]);
        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfos[2]);

        $this->checkTestClass1($classInfos[0]);
    }

    public function testBuildClassInfosBasedOnPath()
    {
        $annotationReader = new AnnotationReader();
        $annotationManager = new AnnotationManager($annotationReader);

        $classInfos = $annotationManager->buildClassInfosBasedOnPath(
            dirname(__DIR__) . '/Classes1'
        );

        $this->assertCount(2, $classInfos);
        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfos[0]);
        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfos[1]);

        $this->checkTestClass1($classInfos[0]);
    }

    public function testBuildClassInfos()
    {
        $annotationReader = new AnnotationReader();
        $annotationManager = new AnnotationManager($annotationReader);

        $classInfos = $annotationManager->buildClassInfos(array(
            new \ReflectionClass(new TestClass1()),
            new \ReflectionClass(new TestClass2())
        ));

        $this->assertCount(2, $classInfos);
        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfos[0]);
        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfos[1]);

        $this->checkTestClass1($classInfos[0]);
    }

    public function testBuildClassInfo()
    {
        $annotationReader = new AnnotationReader();
        $annotationManager = new AnnotationManager($annotationReader);

        $classInfo = $annotationManager->buildClassInfo(
            new \ReflectionClass(new TestClass1())
        );

        $this->assertInstanceOf('Saxulum\\AnnotationManager\\Helper\\ClassInfo', $classInfo);

        $this->checkTestClass1($classInfo);
    }

    /**
     * @param ClassInfo $classInfo
     */
    protected function checkTestClass1(ClassInfo $classInfo)
    {
        $this->assertEquals('Saxulum\Tests\AnnotationManager\Classes1\TestClass1', $classInfo->getName());

        $propertyInfos = $classInfo->getPropertyInfos();
        $this->assertCount(1, $propertyInfos);
        $propertyAnnotations = $propertyInfos[0]->getAnnotations();
        $this->assertCount(1, $propertyAnnotations);
        $this->assertInstanceOf('Saxulum\Tests\AnnotationManager\Annotation\TestAnnotationB', $propertyAnnotations[0]);
        $this->assertFalse($propertyAnnotations[0]->value);

        $methodInfos = $classInfo->getMethodInfos();
        $this->assertCount(3, $methodInfos);
        $methodAnnotations = $methodInfos[0]->getAnnotations();
        $this->assertEquals('test1', $methodInfos[0]->getName());
        $this->assertCount(2, $methodAnnotations);
        $this->assertInstanceOf('Saxulum\Tests\AnnotationManager\Annotation\TestAnnotationA', $methodAnnotations[0]);
        $this->assertEquals('test1', $methodAnnotations[0]->value);
        $this->assertInstanceOf('Saxulum\Tests\AnnotationManager\Annotation\TestAnnotationB', $methodAnnotations[1]);
        $this->assertTrue($methodAnnotations[1]->value);
        $methodAnnotations = $methodInfos[1]->getAnnotations();
        $this->assertEquals('test2', $methodInfos[1]->getName());
        $this->assertCount(1, $methodAnnotations);
        $this->assertInstanceOf('Saxulum\Tests\AnnotationManager\Annotation\TestAnnotationB', $methodAnnotations[0]);
        $this->assertTrue($methodAnnotations[0]->value);
        $this->assertCount(0, $methodInfos[2]->getAnnotations());
        $this->assertEquals('test3', $methodInfos[2]->getName());
    }

    /**
     * @param ClassInfo $classInfo
     */
    protected function checkTestClass2(ClassInfo $classInfo)
    {
        $this->assertEquals('Saxulum\Tests\AnnotationManager\Classes1\TestClass2', $classInfo->getName());
    }

    /**
     * @param ClassInfo $classInfo
     */
    protected function checkTestClass3(ClassInfo $classInfo)
    {
        $this->assertEquals('Saxulum\Tests\AnnotationManager\Classes2\TestClass3', $classInfo->getName());
    }
}

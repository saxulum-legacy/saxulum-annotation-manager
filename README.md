saxulum-annotation-manager
==========================

**works with plain silex-php**

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-annotation-manager.png?branch=master)](https://travis-ci.org/saxulum/saxulum-annotation-manager)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-annotation-manager/downloads.png)](https://packagist.org/packages/saxulum/saxulum-annotation-manager)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-annotation-manager/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-annotation-manager)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saxulum/saxulum-annotation-manager/badges/quality-score.png?s=f7cf1fffbfd39b9ba6e9337dc3172de39e25b20c)](https://scrutinizer-ci.com/g/saxulum/saxulum-annotation-manager/)

Features
--------

* An annotation manager

Requirements
------------

* php >=5.3
* Doctrine Annotations >=1.1
* Saxulum ClassFinder >=1.0
* Symfony Finder Component >=2.3

Installation
------------

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-annotation-manager][1].

### AnnotationRegistry

Add this line after you added the `autoload.php` from composer

```{.php}
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
```

Usage
-----

### Prepare the annotation Manager

```{.php}
use Doctrine\Common\Annotations\AnnotationReader;
use Saxulum\AnnotationManager\Manager\AnnotationManager;

$annotationReader = new AnnotationReader();
$annotationManager = new AnnotationManager($annotationReader);
```

### ClassInfo based on paths
This will search each instantiable class within the given paths
and return em as an array of `Saxulum\AnnotationManager\Helper\ClassInfo`
instances.

```{.php}
$classInfos = $annotationManager->buildClassInfosBasedOnPaths(array(
    dirname(__DIR__) . '/Classes1',
    dirname(__DIR__) . '/Classes2'
));
```

### ClassInfo based on path
This will search each instantiable class within the given path
and return em as an array of `Saxulum\AnnotationManager\Helper\ClassInfo`
instances.

```{.php}
$classInfos = $annotationManager->buildClassInfosBasedOnPath(
    dirname(__DIR__) . '/Classes1'
);
```

### ClassInfo based on reflection classes
This will return an array of `Saxulum\AnnotationManager\Helper\ClassInfo`
instances based on the given ReflectionClasses.

```{.php}
$classInfos = $annotationManager->buildClassInfos(array(
    new \ReflectionClass(new TestClass1()),
    new \ReflectionClass(new TestClass2())
));
```

### ClassInfo based on reflection class
This will return an instance of `Saxulum\AnnotationManager\Helper\ClassInfo`
based on the given ReflectionClass.

```{.php}
$classInfo = $annotationManager->buildClassInfo(
    new \ReflectionClass(new TestClass1())
);
```

### ReflectionClasses based on path
This will search each instantiable class within the given path
and return em as an array of `\ReflectionClass` instances.

```{.php}
$reflectionClasses = AnnotationManager::getReflectionClasses(dirname(__DIR__) . '/Classes1');
```

### Classes based on SplFileInfo
This will search each class within the given file and return em
as an array of class names.

```{.php}
$classes = AnnotationManager::findClassesWithinAFile(
    new SplFileInfo(
        dirname(__DIR__) . '/Classes1/TestClass1.php',
        '',
        'TestClass1.php'
    )
);
```

[1]: https://packagist.org/packages/saxulum/saxulum-annotation-manager
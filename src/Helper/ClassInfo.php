<?php

namespace Saxulum\AnnotationManager\Helper;

class ClassInfo extends AbstractInfo
{
    /**
     * @var PropertyInfo[]
     */
    protected $propertyInfos;

    /**
     * @var MethodInfo[]
     */
    protected $methodInfos;

    /**
     * @param string         $name
     * @param array          $annotations
     * @param PropertyInfo[] $propertyInfos
     * @param MethodInfo[]   $methodInfos
     */
    public function __construct(
        $name,
        array $annotations = array(),
        array $propertyInfos = array(),
        array $methodInfos = array()
    ) {
        parent::__construct($name, $annotations);

        $this->propertyInfos = $propertyInfos;
        $this->methodInfos = $methodInfos;
    }

    /**
     * @return string
     */
    public function getServiceId()
    {
        return str_replace('\\', '.', strtolower($this->getName()));
    }

    /**
     * @return PropertyInfo[]
     */
    public function getPropertyInfos()
    {
        return $this->propertyInfos;
    }

    /**
     * @return MethodInfo[]
     */
    public function getMethodInfos()
    {
        return $this->methodInfos;
    }
}

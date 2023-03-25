<?php
declare(strict_types=1);

namespace App\Core;


use ReflectionMethod;

abstract class Entity
{
    public function __construct(array $data = null)
    {
        if ($data !== null) {
           $this->populate($data);
        }
    }

    public function populate(array $data) : void
    {
        foreach ($data as $propertyName => $value) {
            $propertyName = str_replace('_', '', ucwords($propertyName, '_'));
            $methodName = "set$propertyName";
            if (method_exists($this, $methodName)) {
                $paramType = (new ReflectionMethod($this, $methodName))->getParameters()[0]->getType()->getName();
                settype($value, $paramType);
                $this->{$methodName}($value);
            }
        }
    }
}

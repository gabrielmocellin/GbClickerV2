<?php
namespace GbClicker\Core;

use Exception;
use ReflectionClass;

class Container
{
    private array $instances = [];

    /**
     * @param string $class
     * @param object $instance
     */
    public function set(string $class, $instance): void
    {
        $this->instances[$class] = $instance;
    }

    /**
     * @param string $class
     * @return object
     * @throws Exception
     */
    public function get(string $class)
    {
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        }

        if (!class_exists($class)) {
            throw new Exception("Class $class does not exist");
        }

        $reflector = new ReflectionClass($class);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class $class is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            $this->instances[$class] = new $class();
            return $this->instances[$class];
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();

            if ($type && !$type->isBuiltin()) {
                $dependencies[] = $this->get($type->getName());
            } else {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolve parameter {$parameter->getName()} for class {$class}");
                }
            }
        }

        $instance = $reflector->newInstanceArgs($dependencies);
        $this->instances[$class] = $instance;

        return $instance;
    }
}

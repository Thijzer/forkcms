<?php

namespace Backend\Modules\Immo\DB;

class ReflectionHydration
{
    public function deHydrate($class) : array
    {
        return (new \ReflectionClass($class))->getProperties();
    }

    public function hydrate(string $class, array $data)
    {
        $reflection = new \ReflectionClass($class);
        $class = $reflection->newInstanceWithoutConstructor();

        foreach ($data as $name => $value) {
            $property = $reflection->getProperty($name);
            $property->setAccessible(true);
            $property->setValue($class, $value);
        }

        return $class;
    }
}

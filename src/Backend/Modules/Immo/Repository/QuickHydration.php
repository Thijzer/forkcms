<?php

namespace Backend\Modules\Immo\DB;

class QuickHydration
{
    public function deHydrate($class) : array
    {
        return (new \ReflectionClass($class))->getProperties();
    }

    public function hydrate(string $class, array $data)
    {
        $class = (new \ReflectionClass($class))->newInstanceWithoutConstructor();

        $hydration = function(array $data) {
            foreach ($data as $name => $value) {
                $this->$name = $value;
            }
        };

        $medium = $hydration->bindTo($class, $class);
        $medium($data);

        return $class;
    }
}

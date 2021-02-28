<?php

namespace App\Import\Serializer;

class BaseSerializer implements SerializerInterface
{
    /**
     * Generic array deserializer by using 'set' methods of provided class
     *
     * @return mixed
     * @throws \ErrorException
     */
    public function deserialize(array $rows, string $class)
    {
        if (!class_exists($class)) {
            throw new \ErrorException('Provided class is non existing');
        }

        $entities = [];

        foreach ($rows as $row) {
            $entity = new $class();

            foreach ($row as $key => $value) {
                $method = $this->getSetter($key);

                if(!method_exists($class, $method)){
                    continue;
                }

                //@TODO in case of type mismatch, error would be thrown.
                $entity->$method($value);
            }

            $entities[] = $entity;
        }

        return $entities;
    }

    private function getSetter(string $key): string
    {
        return 'set' . ucfirst($key);
    }
}
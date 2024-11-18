<?php

namespace NewCo\UserService\Models;

class Model
{
    private array $attributes;

    public function __construct(array $properties = []) {
        $this->attributes = $properties;
    }

    public function __set(string $attribute, mixed $value) {
        return $this->attributes[$attribute] = $value;
    }

    public function __get(string $attribute) {
        if (array_key_exists($attribute, $this->attributes)) {
            return $this->attributes[$attribute];
        }
        return null;
    }
}
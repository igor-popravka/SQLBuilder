<?php

declare(strict_types=1);

namespace SQLBuilder;


class Field implements IField {
    private $name;

    public function __construct (string $name) {
        $this->name = $name;
    }
}
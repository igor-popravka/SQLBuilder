<?php

declare(strict_types=1);

namespace SQLBuilder;


interface IField {
    public function __construct (string $name);
}
<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


interface IUpdate {
    public function __construct (string $table);

    public function set (string $column, $value): IUpdate;

    public function where (string $expression);
}
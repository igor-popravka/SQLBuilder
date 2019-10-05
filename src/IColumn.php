<?php

declare(strict_types=1);

namespace SQLBuilder;


interface IColumn {
    public function __construct(string $name, ITable $table);

    public function name(): string;
}
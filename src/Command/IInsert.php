<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\ITable;

interface IInsert {
    public function __construct(ITable $table);

    public function columns(string ...$column): IInsert;

    public function values(...$value): IInsert;
}
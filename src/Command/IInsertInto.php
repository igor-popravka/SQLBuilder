<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


interface IInsertInto {
    public function __construct(string $table);

    public function columns(string ...$column): IInsertInto;

    public function values(...$value): IInsertInto;
}
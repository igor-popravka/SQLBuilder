<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\ITable;

interface IInsert extends ICommand {
    public function __construct(ITable $table);

    public function columns(string ...$column): IInsert;

    public function values(...$value): IInsert;
}
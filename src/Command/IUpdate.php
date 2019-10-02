<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\ITable;

interface IUpdate extends ICommand {
    public function __construct (ITable $table);

    public function set (string $column, $value): IUpdate;

    public function where (string $expression);
}
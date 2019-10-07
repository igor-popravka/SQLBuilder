<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\ITable;

interface IFrom extends ICommand {
    public function __construct (ITable $table, ITable ...$_table);

    public function innerJoin(ITable $table): IJoin;
}
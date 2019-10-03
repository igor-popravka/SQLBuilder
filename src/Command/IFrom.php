<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\ITable;

interface IFrom extends ICommand {
    public function __construct (ITable $table);
}
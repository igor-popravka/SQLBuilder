<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\ITable;

interface IFrom {
    public function __construct (ITable $table);
}
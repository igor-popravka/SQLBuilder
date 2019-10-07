<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\IColumn;
use SQLBuilder\ITable;

interface IJoin {
    public function __construct(ITable $table, IFrom $from);

    public function on(IColumn $column_left, IColumn $column_right): IFrom;
}
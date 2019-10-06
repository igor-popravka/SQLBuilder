<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;

use SQLBuilder\IExpression;
use SQLBuilder\ITable;

interface ISelect extends ICommand  {
    public function __construct (IExpression ...$expression);

    public function from (ITable $table, ITable ...$_table): IFrom;
}
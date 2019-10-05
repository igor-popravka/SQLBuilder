<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\ITable;

interface ISelect extends ICommand  {
    const EXPRESSION_ALL = '*';

    public function __construct (string $expression = ISelect::EXPRESSION_ALL, string ...$_expression);

    public function from (ITable $table): IFrom;
}
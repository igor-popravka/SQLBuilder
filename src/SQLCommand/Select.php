<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\Column;
use SQLBuilder\IExpression;
use SQLBuilder\ITable;
use SQLBuilder\IStatement;

class Select implements ISelect, IStatement {
    /**
     * @var IExpression[]|Column[]
     */
    private $expressions = [];

    /**
     * @var From
     */
    private $from;

    public function __construct (IExpression ...$expression) {
        $this->expressions = $expression;
    }

    /**
     * @param ITable $table
     * @param ITable ...$_table
     * @return IFrom|From
     */
    public function from (ITable $table, ITable ...$_table): IFrom {
        if (!isset($this->from)) {
            $this->from = new From($table, ...$_table);
        }
        return $this->from;
    }

    /**
     * @return string
     */
    public function getStatement (): string {
        $expressions = '*';

        if (!empty($this->expressions)) {
            $expressions = '';
            foreach ($this->expressions as $expression) {
                if (next($this->expressions)) {
                    $expressions .= "{$expression->getStatement()}, ";
                } else {
                    $expressions .= "{$expression->getStatement()}";
                }
            }
        }

        if (isset($this->from)) {
            $expressions .= " {$this->from->getStatement()}";
        }

        return "SELECT {$expressions};";
    }
}
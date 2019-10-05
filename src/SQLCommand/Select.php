<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\ITable;
use SQLBuilder\SQLException;
use SQLBuilder\IStatement;

class Select implements ISelect, IStatement {
    /**
     * @var string[]
     */
    private $expressions;
    /**
     * @var From
     */
    private $from;

    public function __construct (string $expression = self::EXPRESSION_ALL, string ...$_expression) {
        if ($expression == self::EXPRESSION_ALL || empty($expression)) {
            $this->expressions = [$expression];
        } else {
            $this->expressions = array_merge([$expression], $_expression);
        }
    }

    /**
     * @param ITable $table
     * @return IFrom
     * @throws SQLException
     */
    public function from (ITable $table): IFrom {
        if (!isset($this->from)) {
            $this->from = new From($table);
        }
        return $this->from;
    }

    /**
     * @return string
     * @throws SQLException
     */
    public function getStatement (): string {
        $expressions = implode(', ', $this->expressions);

        return "SELECT {$expressions} {$this->from->getStatement()};";
    }
}
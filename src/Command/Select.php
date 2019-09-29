<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\SQLException;

class Select implements ISelect, ICommand {
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
     * @param string $table
     * @return IFrom
     * @throws SQLException
     */
    public function from (string $table): IFrom {
        if (!isset($this->from)) {
            $this->from = new From($table);
        }
        return $this->from;
    }

    /**
     * @return string
     * @throws SQLException
     */
    public function getSql (): string {
        $expressions = implode(', ', $this->expressions);
        $from = isset($this->from) ? ' ' . $this->from->getSql() : '';

        if ($expressions == self::EXPRESSION_ALL && empty($from)) {
            throw SQLException::create(SQLException::E_MSG_NO_TABLE_USED, SQLException::E_CODE_NO_TABLE_USED);
        }

        return "SELECT {$expressions}{$from};";
    }
}
<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\ITable;
use SQLBuilder\Table;
use SQLBuilder\IStatement;

class From implements IFrom, IStatement {
    /**
     * @var Table[]
     */
    private $tables = [];

    /**
     * From constructor.
     * @param ITable $table
     * @param ITable ...$_table
     */
    public function __construct (ITable $table, ITable ...$_table) {
        $this->tables[] = $table;

        if (!empty($_table)) {
            $this->tables = array_merge($this->tables, $_table);
        }
    }

    /**
     * @return string
     */
    public function getStatement (): string {
        $statement = '';

        if (!empty($this->tables)) {
            $statement = 'FROM ';
            foreach ($this->tables as $table) {
                if (next($this->tables)) {
                    $statement .= "{$table->getStatement()}, ";
                } else {
                    $statement .= "{$table->getStatement()}";
                }
            }
        }

        return $statement;
    }
}
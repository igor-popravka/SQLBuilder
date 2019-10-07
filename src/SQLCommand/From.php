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
     * @var InnerJoin[]
     */
    private $joins = [];

    /**
     * From constructor.
     * @param ITable $table
     * @param ITable|ITable[] ...$_table
     */
    public function __construct(ITable $table, ITable ...$_table) {
        $this->tables[] = $table;

        if (!empty($_table)) {
            $this->tables = array_merge($this->tables, $_table);
        }
    }

    /**
     * @return string
     */
    public function getStatement(): string {
        $statement = '';

        foreach ($this->tables as $table) {
            if (next($this->tables)) {
                $statement .= " {$table->getStatement()},";
            } else {
                $statement .= " {$table->getStatement()}";
            }
        }

        foreach ($this->joins as $join) {
            $statement .= " {$join->getStatement()}";
        }

        return "FROM{$statement}";
    }

    public function innerJoin(ITable $table): IJoin {
        $join = new InnerJoin($table, $this);
        $this->joins[] = $join;
        return $join;
    }
}
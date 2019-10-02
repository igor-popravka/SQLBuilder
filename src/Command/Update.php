<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\ITable;
use SQLBuilder\SQLException;
use SQLBuilder\IStatement;

class Update implements IUpdate, IStatement {
    /**
     * @var ITable
     */
    private $table;

    /**
     * @var array
     */
    private $columns = [];

    /**
     * @var string
     */
    private $where;

    /**
     * Update constructor.
     * @param ITable $table
     * @throws SQLException
     */
    public function __construct (ITable $table) {
        $this->table = $table;
    }

    /**
     * @return string
     * @throws SQLException
     */
    public function getStatement (): string {
        if (empty($this->columns)) {
            throw SQLException::create('Data to updating are not set.');
        }

        $statement = "UPDATE {$this->table->getName()} SET ";
        foreach ($this->columns as $column => $value) {
            $statement .= "{$column}='{$value}'";

            if (next($this->columns) !== false) $statement .= ', ';
        }

        if (!empty($this->where)) {
            $statement .= " WHERE {$this->where}";
        }

        $statement .= ';';
        return $statement;
    }

    /**
     * @param string $column
     * @param $value
     * @return IUpdate|Update
     */
    public function set (string $column, $value): IUpdate {
        $this->columns[$column] = $value;
        return $this;
    }

    /**
     * @param string $expression
     */
    public function where (string $expression) {
        $this->where = $expression;
    }
}
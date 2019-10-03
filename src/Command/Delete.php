<?php

declare(strict_types=1);

namespace SQLBuilder\Command;

use SQLBuilder\ITable;
use SQLBuilder\SQLException;
use SQLBuilder\IStatement;


class Delete implements IDelete, IStatement {
    /**
     * @var ITable
     */
    private $table;

    /**
     * @var string
     */
    private $where;

    /**
     * Delete constructor.
     * @param ITable $table
     * @throws SQLException
     */
    public function __construct(ITable $table) {
        $this->table = $table;
    }

    public function getStatement(): string {
        $statement = "DELETE FROM {$this->table->name()}";

        if (!empty($this->where)) {
            $statement .= " WHERE {$this->where}";
        }

        $statement .= ';';
        return $statement;
    }

    /**
     * @param string $expression
     */
    public function where(string $expression) {
        $this->where = $expression;
    }
}
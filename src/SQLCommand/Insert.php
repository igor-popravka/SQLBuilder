<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\ITable;
use SQLBuilder\SQLException;
use SQLBuilder\IStatement;

class Insert implements IInsert, IStatement {
    /**
     * @var ITable
     */
    private $table;

    /**
     * @var array
     */
    private $columns = [];

    /**
     * @var array
     */
    private $values = [];


    /**
     * InsertInto constructor.
     * @param ITable $table
     * @throws SQLException
     */
    public function __construct(ITable $table) {
        $this->table = $table;
    }

    /**
     * @param string[] ...$columns
     * @return IInsert|Insert
     * @throws SQLException
     */
    public function columns(string ...$columns): IInsert {
        if (!empty($this->columns)) {
            throw SQLException::create('The columns already set.');
        }

        $this->columns = $columns;

        return $this;
    }

    /**
     * @param array ...$values
     * @return IInsert|Insert
     * @codeCoverageIgnore
     */
    public function values(...$values): IInsert {
        $this->values[] = $values;

        return $this;
    }

    /**
     * @return string
     * @throws SQLException
     */
    public function getStatement(): string {
        if (empty($this->values)) {
            throw SQLException::create('The values should be set before statement.');
        }

        $statement = "INSERT INTO {$this->table->name()}";

        if (!empty($this->columns)) {
            $statement .= sprintf(' (%s)', implode(', ', $this->columns));
        }

        $statement .= ' VALUES';

        foreach ($this->values as $value) {
            $statement .= sprintf(" (%s)%s",
                implode(', ', array_map(function ($v) {
                    return "'{$v}'";
                }, $value)),
                end($this->values) == $value ? ';' : ','
            );
        }

        return $statement;
    }
}
<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\SQLException;

class InsertInto implements IInsertInto, ICommand {
    /**
     * @var string
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
     * @param string $table
     * @throws SQLException
     */
    public function __construct(string $table) {
        if (empty($table)) {
            throw SQLException::create(SQLException::E_MSG_NO_TABLE_USED, SQLException::E_CODE_NO_TABLE_USED);
        }

        $this->table = $table;
    }

    /**
     * @param string[] ...$columns
     * @return IInsertInto|InsertInto
     * @throws SQLException
     */
    public function columns(string ...$columns): IInsertInto {
        if (!empty($this->columns)) {
            throw SQLException::create('The columns already set.');
        }

        $this->columns = $columns;

        return $this;
    }

    /**
     * @param array ...$values
     * @return IInsertInto|InsertInto
     * @codeCoverageIgnore
     */
    public function values(...$values): IInsertInto {
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

        $statement = "INSERT INTO {$this->table}";

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
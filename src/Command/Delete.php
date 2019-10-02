<?php

declare(strict_types=1);

namespace SQLBuilder\Command;

use SQLBuilder\SQLException;


class Delete implements IDelete, ICommand {
    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $where;

    /**
     * Delete constructor.
     * @param string $table
     * @throws SQLException
     */
    public function __construct(string $table) {
        if (empty($table)) {
            throw SQLException::create(SQLException::E_MSG_NO_TABLE_USED, SQLException::E_CODE_NO_TABLE_USED);
        }

        $this->table = $table;
    }

    public function getStatement(): string {
        $statement = "DELETE FROM {$this->table}";

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
<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\SQLException;

class From implements IFrom, ICommand {
    /**
     * @var string
     */
    private $table;

    /**
     * From constructor.
     * @param string $table
     * @throws SQLException
     */
    public function __construct (string $table) {
        if (empty($table)) {
            throw SQLException::create(SQLException::E_MSG_NO_TABLE_USED, SQLException::E_CODE_NO_TABLE_USED);
        }

        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getStatement(): string {
        return "FROM {$this->table}";
    }
}
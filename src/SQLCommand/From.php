<?php

declare(strict_types=1);

namespace SQLBuilder\SQLCommand;


use SQLBuilder\ITable;
use SQLBuilder\SQLException;
use SQLBuilder\IStatement;

class From implements IFrom, IStatement {
    /**
     * @var ITable
     */
    private $table;

    /**
     * From constructor.
     * @param ITable $table
     * @throws SQLException
     */
    public function __construct (ITable $table) {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getStatement(): string {
        return "FROM {$this->table->name()}";
    }
}
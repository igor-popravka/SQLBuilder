<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


use SQLBuilder\ITable;
use SQLBuilder\SQLException;

class From implements IFrom, ICommand {
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
        return "FROM {$this->table->getName()}";
    }
}
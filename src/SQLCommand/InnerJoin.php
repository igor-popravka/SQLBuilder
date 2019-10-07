<?php

namespace SQLBuilder\SQLCommand;

use SQLBuilder\Column;
use SQLBuilder\IColumn;
use SQLBuilder\IStatement;
use SQLBuilder\ITable;
use SQLBuilder\SQLException;
use SQLBuilder\Table;

/**
 * @author: igor.popravka
 * Date: 07.10.2019
 * Time: 17:23
 */
class InnerJoin implements IJoin, IStatement {
    /**
     * @var From
     */
    private $from;

    /**
     * @var Table
     */
    private $table;

    /**
     * @var Column
     */
    private $column_left;

    /**
     * @var Column
     */
    private $column_right;

    /**
     * Join constructor.
     * @param ITable $table
     * @param IFrom $from
     */
    public function __construct(ITable $table, IFrom $from) {
        $this->table = $table;
        $this->from = $from;
    }

    public function on(IColumn $column_left, IColumn $column_right): IFrom {
        $this->column_left = $column_left;
        $this->column_right = $column_right;

        return $this->from;
    }

    public function getStatement(): string {
        if (!isset($this->column_left) || !isset($this->column_right)) {
            throw SQLException::create("Use operator ON to point referral columns.");
        }

        return "INNER JOIN {$this->table->getStatement()} ON {$this->column_left->getStatement()} = {$this->column_right->getStatement()}";
    }
}
<?php


namespace SQLBuilder\Command;


use phpDocumentor\Reflection\Types\This;
use SQLBuilder\SQLException;

class Update implements IUpdate, ICommand {
    /**
     * @var string
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
     * @throws SQLException
     */
    public function getStatement (): string {
        if (empty($this->columns)) {
            throw SQLException::create('Data to updating are not set.');
        }

        $statement = "UPDATE {$this->table} SET ";
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
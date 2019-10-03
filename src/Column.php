<?php

declare(strict_types=1);

namespace SQLBuilder;


class Column implements IColumn, IExpression, IStatement {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var ITable
     */
    private $table;

    /**
     * @var array
     */
    private $functions = [];

    public function __construct(string $name, ITable $table) {
        $this->name = $name;
        $this->table = $table;
    }

    /**
     * @param string $format
     * @param string $culture
     * @return IColumn
     */
    public function format(string $format, string $culture): IColumn {
        //todo: implement in separate STATIC class with STATIC function
        $this->functions['FORMAT'] = ["'{$format}'", "'{$culture}'"];
        return $this;
    }

    /**
     * @param string $alias
     * @return IExpression|IColumn
     */
    public function as(string $alias): IExpression {
        $this->alias = $alias;
        return $this;
    }

    public function getStatement(): string {
        $statement = sprintf('%s.%s',
            $this->table->alias() ?? $this->table->name(),
            $this->name
        );

        if (isset($this->functions['FORMAT'])) {
            $statement = sprintf("FORMAT({$statement}, %s)", implode(', ', $this->functions['FORMAT']));
        }

        if (isset($this->alias)) {
            $statement = "{$statement} AS {$this->alias}";
        }

        return $statement;
    }
}
<?php

declare(strict_types=1);

namespace SQLBuilder;

use SQLBuilder\SQLFunction\TFormat;
use SQLBuilder\SQLKeyword\TAlias;

/**
 * @author: igor.popravka
 * Date: 02.10.2019
 * Time: 13:35
 *
 * @method as(string $alias = null) :? string
 * @method format(string $format, string $culture)
 */
class Column implements IColumn, IStatement {
    use TAlias, TFormat;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ITable
     */
    private $table;

    public function __construct (string $name, ITable $table) {
        $this->name = $name;
        $this->table = $table;
    }

    public function getStatement (): string {
        $statement = $this->name();

        foreach ($this->functions as $view) {
            $statement = $this->renderFunction($view, $statement);
        }

        return $this->as() ? "{$statement} AS {$this->as()}" : $statement;
    }

    public function name (): string {
        return sprintf('%s.%s',
            $this->table->as() ?? $this->table->name(),
            $this->name
        );
    }
}
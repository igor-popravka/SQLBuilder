<?php

declare(strict_types=1);

namespace SQLBuilder;

/**
 * @author: igor.popravka
 * Date: 02.10.2019
 * Time: 13:35
 */
class Table implements ITable, IExpression {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $alias;

    public function __construct(string $name) {
        $this->name = trim($name, '` ');
    }

    public function name(): string {
        if (empty($this->name)) {
            throw SQLException::create(SQLException::E_MSG_NO_TABLE_USED, SQLException::E_CODE_NO_TABLE_USED);
        }

        return "`{$this->name}`";
    }

    public function as(string $alias): IExpression {
        $this->alias = $alias;
        return $this;
    }

    public function alias():? string {
        return $this->alias;
    }
}
<?php

declare(strict_types=1);

namespace SQLBuilder;

use SQLBuilder\SQLKeyword\TAlias;

/**
 * @author: igor.popravka
 * Date: 02.10.2019
 * Time: 13:35
 *
 * @method as(string $alias = null) :? string
 */
class Table implements ITable {
    use TAlias;
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name) {
        $this->name = trim($name, '` ');
    }

    public function name(): string {
        if (empty($this->name)) {
            throw SQLException::create(SQLException::E_MSG_NO_TABLE_USED, SQLException::E_CODE_NO_TABLE_USED);
        }

        return "`{$this->name}`";
    }
}
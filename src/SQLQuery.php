<?php

declare(strict_types=1);

namespace SQLBuilder;


use SQLBuilder\SQLCommand\ICommand;
use SQLBuilder\SQLCommand\Select;

class SQLQuery implements ISQLQuery {
    /**
     * @return ICommand|Select
     */
    public function select(): ICommand {
        return new Select();
    }

    public function insert(): ICommand {
        // TODO: Implement insert() method.
    }

    public function update(): ICommand {
        // TODO: Implement update() method.
    }

    public function delete(): ICommand {
        // TODO: Implement delete() method.
    }
}
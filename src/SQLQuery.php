<?php

declare(strict_types=1);

namespace SQLBuilder;


use SQLBuilder\Command\ICommand;

class SQLQuery implements ISQLQuery {
    public function select(): ICommand {
        // TODO: Implement select() method.
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
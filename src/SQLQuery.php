<?php

declare(strict_types=1);

namespace SQLBuilder;


use SQLBuilder\Command\IStatement;

class SQLQuery implements ISQLQuery {
    public function select(): IStatement {
        // TODO: Implement select() method.
    }

    public function insert(): IStatement {
        // TODO: Implement insert() method.
    }

    public function update(): IStatement {
        // TODO: Implement update() method.
    }

    public function delete(): IStatement {
        // TODO: Implement delete() method.
    }
}
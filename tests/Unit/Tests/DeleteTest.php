<?php

declare(strict_types=1);

namespace Unit\Tests;

use SQLBuilder\SQLCommand\Delete;
use PHPUnit\Framework\TestCase;
use SQLBuilder\Table;

class DeleteTest extends TestCase {

    public function testGetStatementWithoutWhere() {
        $delete = new Delete(new Table('users'));
        self::assertEquals('DELETE FROM `users`;', $delete->getStatement());
    }

    public function testGetStatementWithWhere() {
        $delete = new Delete(new Table('users'));
        $delete->where('id=123');

        self::assertEquals('DELETE FROM `users` WHERE id=123;', $delete->getStatement());
    }
}

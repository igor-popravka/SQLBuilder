<?php

declare(strict_types=1);

namespace Unit\Tests;

use SQLBuilder\Command\Delete;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase {

    public function testGetStatementWithoutWhere() {
        $delete = new Delete('users');
        self::assertEquals('DELETE FROM users;', $delete->getStatement());
    }

    public function testGetStatementWithWhere() {
        $delete = new Delete('users');
        $delete->where('id=123');

        self::assertEquals('DELETE FROM users WHERE id=123;', $delete->getStatement());
    }
}

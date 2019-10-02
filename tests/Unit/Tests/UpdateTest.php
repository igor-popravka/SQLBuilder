<?php

declare(strict_types=1);

namespace Unit\Tests;

use SQLBuilder\Command\Update;
use PHPUnit\Framework\TestCase;
use SQLBuilder\SQLException;
use SQLBuilder\Table;

class UpdateTest extends TestCase {

    public function testGetStatement () {
        $update = new Update(new Table('users'));
        $update->set('col1', 123)->set('col2', 'name')->where('id=23');

        self::assertEquals("UPDATE `users` SET col1='123', col2='name' WHERE id=23;", $update->getStatement());
    }

    public function testGetStatementErrorDataNotSet () {
        self::expectException(SQLException::class);
        self::expectExceptionMessage('Data to updating are not set.');

        $update = new Update(new Table('users'));
        $update->getStatement();
    }
}

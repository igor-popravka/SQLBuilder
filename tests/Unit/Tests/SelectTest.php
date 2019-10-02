<?php

declare(strict_types=1);

namespace Unit\Tests;

use PHPUnit\Framework\TestCase;
use SQLBuilder\Command\Select;
use SQLBuilder\SQLException;
use SQLBuilder\Table;

class SelectTest extends TestCase {

    public function testGetStatementDefaultExpression() {
        $select = new Select();
        $select->from(new Table('users'));

        self::assertEquals('SELECT * FROM `users`;', $select->getStatement());
    }

    public function testGetStatementExpression() {
        $select = new Select("CONCAT ( name, ' ', surname) AS FullName", 'CURDATE() AS Date');
        $select->from(new Table('users'));

        self::assertEquals("SELECT CONCAT ( name, ' ', surname) AS FullName, CURDATE() AS Date FROM `users`;", $select->getStatement());
    }

    public function testGetStatementErrorNoTablesUsed() {
        self::expectException(SQLException::class);
        self::expectExceptionMessage(SQLException::E_MSG_NO_TABLE_USED);
        self::expectExceptionCode(SQLException::E_CODE_NO_TABLE_USED);

        $select = new Select("NOW()");
        $select->from(new Table(''));

        self::assertEquals("SELECT NOW();", $select->getStatement());
    }
}

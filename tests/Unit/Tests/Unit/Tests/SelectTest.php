<?php

declare(strict_types=1);

namespace Unit\Tests;

use PHPUnit\Framework\TestCase;
use SQLBuilder\Command\From;
use SQLBuilder\Command\ICommand;
use SQLBuilder\Command\IFrom;
use SQLBuilder\Command\ISelect;
use SQLBuilder\Command\Select;
use SQLBuilder\SQLException;

class SelectTest extends TestCase {

    public function testSelectInstances () {
        $select = new Select();

        self::assertInstanceOf(ISelect::class, $select);
        self::assertInstanceOf(ICommand::class, $select);
    }

    public function testGetSqlErrorNoTableUsed () {
        self::expectException(SQLException::class);
        self::expectExceptionMessage(SQLException::E_MSG_NO_TABLE_USED);
        self::expectExceptionCode(SQLException::E_CODE_NO_TABLE_USED);

        $select = new Select();
        $select->getSql();
    }

    public function testGetSqlDefaultExpression () {
        $select = new Select();
        $select->from('users');

        self::assertEquals('SELECT * FROM users;', $select->getSql());
    }

    public function testGetSqlExpression () {
        $select = new Select("CONCAT ( name, ' ', surname) AS FullName", 'CURDATE() AS Date');
        $select->from('users');

        self::assertEquals("SELECT CONCAT ( name, ' ', surname) AS FullName, CURDATE() AS Date FROM users;", $select->getSql());
    }

    public function testFrom () {
        $select = new Select();
        $from = $select->from('users');

        self::assertInstanceOf(From::class, $from);
        self::assertInstanceOf(IFrom::class, $from);
        self::assertInstanceOf(ICommand::class, $from);
    }

    public function testFromErrorNoTableUsed () {
        self::expectException(SQLException::class);
        self::expectExceptionMessage(SQLException::E_MSG_NO_TABLE_USED);
        self::expectExceptionCode(SQLException::E_CODE_NO_TABLE_USED);

        $select = new Select();
        $select->from('');
    }
}

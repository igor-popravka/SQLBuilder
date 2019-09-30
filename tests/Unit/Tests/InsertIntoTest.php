<?php

declare(strict_types=1);

namespace Unit\Tests;

use SQLBuilder\Command\ICommand;
use SQLBuilder\Command\IInsertInto;
use SQLBuilder\Command\InsertInto;
use PHPUnit\Framework\TestCase;
use SQLBuilder\SQLException;

class InsertIntoTest extends TestCase {

    public function testInsertIntoInstance() {
        $insert = new InsertInto('table');

        self::assertInstanceOf(IInsertInto::class, $insert);
        self::assertInstanceOf(ICommand::class, $insert);
    }

    public function testConstructErrorNoTableUsed() {
        self::expectException(SQLException::class);
        self::expectExceptionMessage(SQLException::E_MSG_NO_TABLE_USED);
        self::expectExceptionCode(SQLException::E_CODE_NO_TABLE_USED);

        new InsertInto('');
    }

    public function testErrorColumnsAlreadySet() {
        self::expectException(SQLException::class);
        self::expectExceptionMessage('The columns already set.');

        $insert = new InsertInto('users');
        $insert->columns('name', 'surname', 'age')
            ->columns('phone', 'address');
    }

    public function testGetStatement() {
        $insert = new InsertInto('users');
        $insert->columns('name', 'phone', 'age')
            ->values('User-1', '+380678923462', 22)
            ->values('User-2', '+380678923466', 36);

        $statement = "INSERT INTO users (name, phone, age) VALUES ('User-1', '+380678923462', '22'), ('User-2', '+380678923466', '36');";

        self::assertEquals($statement, $insert->getStatement());
    }

    public function testGetStatementErrorValuesShouldBeSet() {
        self::expectException(SQLException::class);
        self::expectExceptionMessage('The values should be set before statement.');

        $insert = new InsertInto('users');
        $insert->columns('name', 'phone', 'age');

        $insert->getStatement();
    }

    public function testGetStatementEmptyColumns() {
        $insert = new InsertInto('users');
        $insert->values('User-1', '+380678923462', 22);

        $statement = "INSERT INTO users VALUES ('User-1', '+380678923462', '22');";

        self::assertEquals($statement, $insert->getStatement());
    }
}

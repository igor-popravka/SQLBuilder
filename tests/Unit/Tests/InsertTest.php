<?php

declare(strict_types=1);

namespace Unit\Tests;

use SQLBuilder\Command\Insert;
use PHPUnit\Framework\TestCase;
use SQLBuilder\SQLException;
use SQLBuilder\Table;

class InsertTest extends TestCase {
    public function testErrorColumnsAlreadySet() {
        self::expectException(SQLException::class);
        self::expectExceptionMessage('The columns already set.');

        $insert = new Insert(new Table('users'));
        $insert->columns('name', 'surname', 'age')
            ->columns('phone', 'address');
    }

    public function testGetStatement() {
        $insert = new Insert(new Table('users'));
        $insert->columns('name', 'phone', 'age')
            ->values('User-1', '+380678923462', 22)
            ->values('User-2', '+380678923466', 36);

        $statement = "INSERT INTO `users` (name, phone, age) VALUES ('User-1', '+380678923462', '22'), ('User-2', '+380678923466', '36');";

        self::assertEquals($statement, $insert->getStatement());
    }

    public function testGetStatementErrorValuesShouldBeSet() {
        self::expectException(SQLException::class);
        self::expectExceptionMessage('The values should be set before statement.');

        $insert = new Insert(new Table('users'));
        $insert->columns('name', 'phone', 'age');

        $insert->getStatement();
    }

    public function testGetStatementEmptyColumns() {
        $insert = new Insert(new Table('users'));
        $insert->values('User-1', '+380678923462', 22);

        $statement = "INSERT INTO `users` VALUES ('User-1', '+380678923462', '22');";

        self::assertEquals($statement, $insert->getStatement());
    }
}

<?php
/**
 * @author: igor.popravka
 * Date: 03.10.2019
 * Time: 13:18
 */

namespace Unit\Tests;

use SQLBuilder\Column;
use PHPUnit\Framework\TestCase;
use SQLBuilder\Table;

class ColumnTest extends TestCase {
    public function testColumnStatement() {
        $table = new Table('users_data');
        $table->as('u');

        $column = new Column('last_activity_date', $table);
        $column->as('Activity');
        $column->format('Y-m-d', 'en-US');

        $statement = $column->getStatement();

        self::assertEquals("FORMAT(u.last_activity_date, 'Y-m-d', 'en-US') AS Activity", $statement);
    }

    public function testColumnStatement2() {
        $table = new Table('users_data');

        $column = new Column('last_activity_date', $table);
        $column->format('Y-m-d', 'en-US');

        $statement = $column->getStatement();

        self::assertEquals("FORMAT(`users_data`.last_activity_date, 'Y-m-d', 'en-US')", $statement);
    }
}

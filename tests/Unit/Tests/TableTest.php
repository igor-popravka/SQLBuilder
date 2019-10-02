<?php

declare(strict_types=1);

namespace Unit\Tests;

use SQLBuilder\SQLException;
use SQLBuilder\Table;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase {
    public function providerGetName() {
        return [
            ['users', '`users`'],
            [' `users `', '`users`'],
            ['', ''],
        ];
    }

    /**
     * @param $name
     * @param $expected
     *
     * @dataProvider providerGetName
     */
    public function testGetName($name, $expected) {
        $table = new Table($name);

        if (empty($name)) {
            self::expectException(SQLException::class);
            self::expectExceptionMessage(SQLException::E_MSG_NO_TABLE_USED);
            self::expectExceptionCode(SQLException::E_CODE_NO_TABLE_USED);
        }

        self::assertEquals($expected, $table->getName());
    }
}

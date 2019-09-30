<?php

namespace Unit\Tests;

use SQLBuilder\Command\Update;
use PHPUnit\Framework\TestCase;
//todo: complete test
class UpdateTest extends TestCase {

    public function testGetStatement () {
        $update = new Update('user');
        $update->set('col1', 123)->set('col2', 'name')->where('id=23');
        echo $update->getStatement();
    }
}

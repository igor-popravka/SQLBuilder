<?php

declare(strict_types=1);

namespace Unit\Tests;

use PHPUnit\Framework\TestCase;
use SQLBuilder\Column;
use SQLBuilder\SQLCommand\Select;
use SQLBuilder\Table;

class SelectTest extends TestCase {

    public function testGetStatement_UseAliases() {
        $tbl_users = new Table('users');
        $tbl_users->as('u');

        $clu_user = new Column('user', $tbl_users);
        $clu_user->as('UN');

        $clu_age = new Column ('birthday', $tbl_users);
        $clu_age->as('BD');
        $clu_age->format('d', 'en-US');

        $tbl_account = new Table('accounts');
        $tbl_account->as('a');

        $cla_acc = new Column('account_number', $tbl_account);
        $cla_acc->as('AN');

        $select = new Select($clu_user, $clu_age, $cla_acc);
        $select->from($tbl_users, $tbl_account);

        self::assertEquals("SELECT u.user AS UN, FORMAT(u.birthday, 'd', 'en-US') AS BD, a.account_number AS AN FROM `users` AS u, `accounts` AS a;", $select->getStatement());
    }

    public function testGetStatement() {
        $tbl_users = new Table('users');
        $clu_user = new Column('user', $tbl_users);
        $clu_age = new Column ('birthday', $tbl_users);
        $clu_age->format('m', 'en-US');

        $tbl_account = new Table('accounts');
        $cla_acc = new Column('account_number', $tbl_account);

        $select = new Select($clu_user, $clu_age, $cla_acc);
        $select->from($tbl_users, $tbl_account);

        self::assertEquals("SELECT `users`.user, FORMAT(`users`.birthday, 'm', 'en-US'), `accounts`.account_number FROM `users`, `accounts`;", $select->getStatement());
    }

    public function testGetStatement_FromInnerJoin() {
        $tbl_users = new Table('users');
        $tbl_users->as('u');

        $clu_user = new Column('user', $tbl_users);
        $clu_user->as('UN');

        $clu_age = new Column ('birthday', $tbl_users);
        $clu_age->as('BD');
        $clu_age->format('d', 'en-US');

        $clu_id = new Column ('user_id', $tbl_users);

        $tbl_account = new Table('accounts');
        $tbl_account->as('a');

        $cla_acc = new Column('account_number', $tbl_account);
        $cla_acc->as('AN');

        $cla_id = new Column ('account_id', $tbl_account);

        $select = new Select($clu_user, $clu_age, $cla_acc);
        $select->from($tbl_users)
            ->innerJoin($tbl_account)->on($clu_id, $cla_id);

        self::assertEquals("SELECT u.user AS UN, FORMAT(u.birthday, 'd', 'en-US') AS BD, a.account_number AS AN FROM `users` AS u INNER JOIN `accounts` AS a ON u.user_id = a.account_id;", $select->getStatement());
    }
}

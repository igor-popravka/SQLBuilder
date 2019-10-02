<?php

declare(strict_types=1);

namespace SQLBuilder\Command;

use SQLBuilder\ITable;

/**
 * @author: igor.popravka
 * Date: 02.10.2019
 * Time: 12:11
 */
interface IDelete extends ICommand {
    public function __construct(ITable $table);

    public function where(string $expression);
}
<?php

declare(strict_types=1);

namespace SQLBuilder\Command;

/**
 * @author: igor.popravka
 * Date: 02.10.2019
 * Time: 12:11
 */
interface IDelete {
    public function __construct(string $table);
}
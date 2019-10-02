<?php

declare(strict_types=1);

namespace SQLBuilder;

/**
 * @author: igor.popravka
 * Date: 02.10.2019
 * Time: 13:34
 */
interface ITable {
    public function __construct(string $name);

    public function getName(): string;
}
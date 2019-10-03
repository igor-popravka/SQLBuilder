<?php

declare(strict_types=1);

namespace SQLBuilder;

/**
 * @author: igor.popravka
 * Date: 03.10.2019
 * Time: 12:31
 */
interface IExpression {
    public function as(string $alias): IExpression;
}
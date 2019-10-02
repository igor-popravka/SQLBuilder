<?php

declare(strict_types=1);

namespace SQLBuilder;


interface IStatement {
    public function getStatement(): string;
}
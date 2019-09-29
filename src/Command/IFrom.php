<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


interface IFrom {
    public function __construct (string $table);
}
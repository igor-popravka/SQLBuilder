<?php

declare(strict_types=1);

namespace SQLBuilder\Command;


interface ICommand {
    public function getSql (): string;
}
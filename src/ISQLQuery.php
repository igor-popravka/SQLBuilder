<?php

declare(strict_types=1);

namespace SQLBuilder;


use SQLBuilder\SQLCommand\ICommand;

interface ISQLQuery {
    public function select(): ICommand;

    public function insert(): ICommand;

    public function update(): ICommand;

    public function delete(): ICommand;
}
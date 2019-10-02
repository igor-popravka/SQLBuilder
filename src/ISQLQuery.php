<?php

declare(strict_types=1);

namespace SQLBuilder;


interface ISQLQuery {
    public function select(): IStatement;

    public function insert(): IStatement;

    public function update(): IStatement;

    public function delete(): IStatement;
}
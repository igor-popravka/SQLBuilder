<?php

declare(strict_types=1);

namespace SQLBuilder\SQLFunction;


trait TFunction {
    protected $functions = [];

    protected function renderFunction (string $view, string $expression): string {
        return str_replace('<expression>', $expression, $view);
    }
}
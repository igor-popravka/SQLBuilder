<?php

declare(strict_types=1);

namespace SQLBuilder\SQLKeyword;


trait TAlias {
    private $alias;

    /**
     * @param string|null $alias
     * @return string|null
     */
    public function as (string $alias = null): ?string {
        if (!empty($alias)) {
            $this->alias = $alias;
        }
        return $this->alias;
    }
}
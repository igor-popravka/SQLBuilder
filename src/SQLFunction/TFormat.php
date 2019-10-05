<?php

declare(strict_types=1);

namespace SQLBuilder\SQLFunction;


trait TFormat {
    use TFunction;

    /**
     * @param string $format
     * @param string $culture
     */
    public function format (string $format, string $culture) {
        $this->functions[] = "FORMAT(<expression>, '{$format}', '{$culture}')";
    }
}
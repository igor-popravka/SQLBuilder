<?php

declare(strict_types=1);

namespace SQLBuilder;


class SQLException extends \Exception {
    const E_MSG_NO_TABLE_USED = 'No tables used';
    const E_CODE_NO_TABLE_USED = 1096;

    /**
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     * @return SQLException
     */
    public static function create ($message = "", $code = 0, \Throwable $previous = null): SQLException {
        return new SQLException($message, $code, $previous = null);
    }
}
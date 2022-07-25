<?php

namespace App\Constants;

class Constants{
    const YEAR = 31536000;
    const MONTH = 2592000;
    const DAY = 86400;
    const HOUR = 3600;
    const MINUTE = 60;
    const SECOND = 1;

    public static function get_constant($name) {
        return constant('self::'.$name);
    }
}
<?php

namespace Src\Utils;

class DateComparator
{
    public static function compare(string $version)
    {
        if (empty($version)) {
            return null;
        }

        if (version_compare($version, STANDARD_TIME_VERSION) <= 0) {
            return "Europe/Berlin";
        }

        return "UTC";
    }
}
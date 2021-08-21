<?php

namespace App\Traits;

trait HelperTrait
{
    protected function extractDateRange(string $date_range_string): array
    {
        $dateRangeString = explode(' - ', $date_range_string);
        $date['date_from'] = date('Y-m-d H:i:s', strtotime($dateRangeString[0]));
        $date['date_to'] = date('Y-m-d H:i:s', strtotime($dateRangeString[1]));
        return $date;
    }
}

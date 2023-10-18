<?php

namespace App\Functions;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DateFunction
{
    public static $WEEKEND = [Carbon::THURSDAY, Carbon::FRIDAY, Carbon::SATURDAY];

    public static function period($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $period = CarbonPeriod::create($startDate, $endDate);

        $dates = [];

        foreach ($period as $date) {
            $dates[] = $date;
        }
        
        return $dates;
    }

    public static function price($period, $price, $exception)
    {
        $length = count($period);
        $endDays = 0;
        foreach ($period as $date) {
            if (in_array($date->dayOfWeek, DateFunction::$WEEKEND))
                $endDays += 1;
        }
        $normalDays = $length - $endDays;
        return ($normalDays * $price) + ($endDays * $exception);
    }
}

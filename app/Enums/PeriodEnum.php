<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PeriodEnum extends Enum
{
    const PERIOD_GUZ  = 'guz';
    const PERIOD_BAHAR  = 'bahar';

    const PERIODS = [
      self [PERIOD_GUZ] => 'Güz',
      //self [PERIOD_BAHAR] => 'Bahar',
    ];

    const PERIODS_DATES = [
      PERIOD_GUZ => [
        'start_date' => '2020-09-14',
        'end_date' => '2021-01-26',
        'lecture_registeration_start_date' => '2020-09-07',
        'lecture_registeration_end_date' => '2020-09-11',
      ],
    ];
}

<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PeriodEnum extends Enum
{
    public const PERIOD_GUZ  = 'guz';
    public const PERIOD_BAHAR  = 'bahar';

    public const PERIODS = [
      self::PERIOD_GUZ => 'Güz',
      self::PERIOD_BAHAR => 'Bahar',
    ];

    public const PERIODS_DATES = [
      self::PERIOD_GUZ => [
        'lecture_registeration_start_date' => '2020-09-07',
        'lecture_registeration_end_date' => '2020-09-11',
        'start_date' => '2020-09-07',
        'end_date' => '2021-01-22',
      ],
      self::PERIOD_BAHAR => [
        'lecture_registeration_start_date' => '2021-02-15',
        'lecture_registeration_end_date' => '2021-02-19',
        'start_date' => '2021-02-15',
        'end_date' => '2021-06-15',
      ],
    ];
}

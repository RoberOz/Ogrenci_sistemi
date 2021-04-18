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
        'lecture_registeration_start_date' => '2020-09-07', //Güz dönemi kayıt dönemi başlangıç tarihi
        'lecture_registeration_end_date' => '2020-09-11', //Güz dönemi kayıt dönemi bitiş tarihi
        'start_date' => '2020-09-07', //Güz dönemi başlangıç tarihi
        'end_date' => '2021-01-22', //Güz dönemi bitiş tarihi
      ],
      self::PERIOD_BAHAR => [
        'lecture_registeration_start_date' => '2021-02-15', //Bahar dönemi kayıt dönemi başlangıç tarihi
        'lecture_registeration_end_date' => '2021-02-19', //Bahar dönemi kayıt dönemi bitiş tarihi
        'start_date' => '2021-02-15', //Bahar dönemi başlangıç tarihi
        'end_date' => '2021-06-15', //Bahar dönemi bitiş tarihi
      ],
    ];
}

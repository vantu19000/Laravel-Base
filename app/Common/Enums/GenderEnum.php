<?php


namespace App\Common\Enums;


class GenderEnum extends Enum
{
    const UNKNOWN = [
        'value' => 0,
        'display' => 'Unknown'
    ];
    const MALE = [
        'value' => 1,
        'display' => 'Male'
    ];
    const FEMALE = [
        'value' => 2,
        'display' => 'Female'
    ];
    const OTHER = [
        'value' => 3,
        'display' => 'Other'
    ];
}

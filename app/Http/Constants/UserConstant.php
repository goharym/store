<?php

namespace App\Http\Constants;

class UserConstant
{
    public const PER_PAGE = 15;

    public const STATUSES = [
        "IN_ACTIVE" => 0,
        "ACTIVE" => 1,
        "SUSPENDED" => 2,
        "BANNED" => 3,
    ];

    public const TYPES = [
        "CONSUMER" => 0,
        "MERCHANT" => 1,
        "ADMIN"=>2
    ];
}

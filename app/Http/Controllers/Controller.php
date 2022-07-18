<?php

namespace App\Http\Controllers;

use App\Http\Constants\UserConstant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * check if the authenticated user is an admin.
     * @return bool
     */
    public static function isAdmin(): bool
    {
        return Auth::user()['type'] == UserConstant::TYPES['ADMIN'];
    }

    /**
     * check if the authenticated user is a merchant.
     * @return bool
     */
    public static function isMerchant(): bool
    {
        return Auth::user()['type'] == UserConstant::TYPES['MERCHANT'];
    }

    /**
     * check if the authenticated user is a consumer.
     * @return bool
     */
    public static function isConsumer(): bool
    {
        return Auth::user()['type'] == UserConstant::TYPES['CONSUMER'];
    }
}

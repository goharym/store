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
     * @return bool
     */
    public static function isAdmin(): bool
    {
        return Auth::user()['type'] == UserConstant::TYPES['ADMIN'];
    }
}

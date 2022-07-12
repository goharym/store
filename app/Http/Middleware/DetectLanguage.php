<?php

namespace App\Http\Middleware;

use App\Http\Constants\LanguageConstant;
use Closure;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as Status;

class DetectLanguage
{
    const LANGUAGE_REQUEST_HEADER = 'Accept-Language';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->is('api*')) {

            if ($request->header(self::LANGUAGE_REQUEST_HEADER) && !in_array($request->header(self::LANGUAGE_REQUEST_HEADER), LanguageConstant::LOCALES)) {

                return Response::clientError('Invalid Language.', Status::HTTP_BAD_REQUEST);

            } else if (!$request->header(self::LANGUAGE_REQUEST_HEADER)) {

                return Response::clientError('Language Absent.', Status::HTTP_BAD_REQUEST);

            } else {

                app()->setLocale($request->header(self::LANGUAGE_REQUEST_HEADER));

            }

        }

        return $next($request);
    }

}

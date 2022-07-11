<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response as Status;

class TokenVariousExceptions
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return Response::clientError(['User not found'], Status::HTTP_UNAUTHORIZED);
            }

        } catch (TokenExpiredException $e) {

            return Response::clientError(['Token Expired.'], Status::HTTP_UNAUTHORIZED);

        } catch (TokenInvalidException $e) {

            return Response::clientError(['Token Invalid'], Status::HTTP_UNAUTHORIZED);

        } catch (JWTException $e) {

            return Response::clientError(['Token Absent'], Status::HTTP_UNAUTHORIZED);

        }

        return $next($request);
    }

}

<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as Status;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($value, $status = Status::HTTP_OK) {

            $response = [
                'success' => true,
                'data' => $value
            ];

            return Response::make($response, $status);
        });

        Response::macro('created', function ($value, $status = Status::HTTP_CREATED) {

            $response = [
                'success' => true,
                'data' => $value
            ];

            return Response::make($response, $status);
        });

        Response::macro('clientError', function ($errors, $status = Status::HTTP_UNPROCESSABLE_ENTITY) {
            $response = [
                'success' => false,
                'error' => $errors
            ];

            return Response::make($response, $status);
        });

        Response::macro('serverError', function ($errors, $status = Status::HTTP_INTERNAL_SERVER_ERROR) {
            $response = [
                'success' => false,
                'error' => $errors
            ];

            return Response::make($response, $status);
        });

        Response::macro('forbiddenAccess', function ($errors, $status = Status::HTTP_FORBIDDEN) {
            $response = [
                'success' => false,
                'error' => $errors
            ];

            return Response::make($response, $status);
        });

        Response::macro('formatErrors', function (MessageBag $messages) {
            $messagesArr = $messages->getMessages();

            return Arr::flatten($messagesArr);
        });
    }
}

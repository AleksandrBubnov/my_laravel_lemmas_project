<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SendGetRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);

        // // моя логика
        // $request->validate([
        //     'name' => 'required|String',
        //     'post_code' => 'required|Numeric',
        //     'description' => 'String',
        // ]);

        // $response = $next($request); // тут отрабатывает контролёр

        // // моя логика

        // // return $next($request); // тут отрабатывает контролёр
        // return $response;
    }
}

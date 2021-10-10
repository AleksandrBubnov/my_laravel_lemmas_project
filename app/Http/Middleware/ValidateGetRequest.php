<?php

namespace App\Http\Middleware;

use App\Models\Word;
use Closure;
use Illuminate\Http\Request;

class ValidateGetRequest
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

        $request->validate([
            'word' => 'required|String',
        ]);
        // abort(404, 'Custom error message');
        // response()->json(['message' => 'Not Found.'], 404);

        // echo "$request->word<br/>";
        // echo PHP_EOL;
        return $next($request);

        // $word = '';
        // if ($request->word) {
        //     $word = Word::where('word', $request->word)
        //         ->get()
        //         ->toArray();
        // }

        // if (!$word) {
        //     echo "if($request->word)<br/><br/>";
        //     echo PHP_EOL;
        //     echo PHP_EOL;
        //     $response = $next($request); // тут отрабатывает контролёр
        //     echo ($response);
        //     echo PHP_EOL;
        //     echo '<br/><br/>end<br/><br/>';
        //     echo PHP_EOL;
        //     return $response;

        //     $word->results = $response['results'];
        //     $word->word = $response['results']['word'];
        //     // $word->save();
        // } else {
        //     $response = $word;
        // }

        // return $response;
    }
}

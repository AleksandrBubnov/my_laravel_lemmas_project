<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressesController extends Controller
{
    protected $request;
    protected $base_url;
    protected $app_id;
    protected $app_key;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->base_url = env('BASE_API_URL_LEMMAS');
        $this->app_id = env('APP_ID_LEMMAS');
        $this->app_key = env('APP_KEY_LEMMAS');
    }

    public function getLemmas()
    {
        $word = $this->request->word;
        $endpoint = $this->base_url .  '/lemmas/en/' . $word;

        // echo 'get Lemmas<br/>';
        // echo PHP_EOL;
        // echo $endpoint;
        // echo '<br/>';
        // echo PHP_EOL;

        $response = Http::withHeaders([
            'app_id' => $this->app_id,
            'app_key' => $this->app_key,
        ])->get($endpoint);

        return $response;
    }

    public function getMyLemmas()
    {
        $word = $this->request->word;
        $endpoint = $this->base_url .  '/lemmas/en/' . $word;

        $dbword = Word::where('word', $word)
            ->get()
            ->toArray();

        if (!$dbword) {
            $dbword = new Word();
            $response = Http::withHeaders([
                'app_id' => $this->app_id,
                'app_key' => $this->app_key,
            ])->get($endpoint);

            $res = [];

            try {
                $res[] = $response['results'][0]['language']; //'language'
                $res[] = $response['results'][0]['word']; //'singular'
                if (
                    isset($response['results'][0]['lexicalEntries'][0]['grammaticalFeatures'][0]['id']) &&
                    $response['results'][0]['lexicalEntries'][0]['grammaticalFeatures'][0]['id'] == 'plural'
                ) {
                    $res[1] = $response['results'][0]['lexicalEntries'][0]["inflectionOf"][0]["text"];
                    $res[] = $response['results'][0]['word']; // 'plural'
                }
            } catch (Exception $e) {
                abort(404, $e->getMessage());
            }

            $response = json_encode($res);

            $dbword->results = $response;
            $dbword->word = $word;
            // die(var_dump($response));
            $dbword->save();
            echo '!!!=> ';
        } else {
            echo 'dbword!!!=> ';
            // die(var_dump(response()->json($dbword)));
            $response = response()->json($dbword);
        }

        return $response;
    }
}

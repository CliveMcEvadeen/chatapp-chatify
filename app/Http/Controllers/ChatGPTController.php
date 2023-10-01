<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\http\jsonResponse;
use GuzzleHttp\Exception\RequestException; // Import RequestException for handling exceptions

class ChatGPTController extends Controller
{
    public function chat(Request $request)
    {
        // Disable SSL certificate verification
        $client = new Client(['verify' => false,]);

        try {
            $response = $client->post('https://api.openai.com/v1/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                ],
                'json' => [
                    'model' => 'davinci',
                    'prompt' => $request->input('message'),
                    'temperature' => 0.7,
                    'max_tokens' => 60,
                    'top_p' => 1,
                    'n' => 1,
                    'stop' => ['\n'],
                    'frequency_penalty' => 0.25,
                    'presence_penalty' => 0.5,
                    'best_of' => 1
                ],
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return response()->json($result['choices'][0]['text']);
        } catch (RequestException $e) {
            // Handle any request exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

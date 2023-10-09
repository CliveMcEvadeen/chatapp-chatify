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
            $response = $client->post('https://generativelanguage.googleapis.com/v1beta2/models/text-bison-001:generateText?key=AIzaSyC-3NtdSDGwZYwtFwBmNFQw3mz8V_K8rcI', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    // 'Authorization' => 'Bearer ' . env('GOOGLE_API_KEY'),
                ],
                'json' => [
                    // 'model' => 'davinci',
                    'prompt' =>array('text'=>'what is the tallest building in the whole world'),
                    "temperature"=>0.7, 
                    "candidate_count"=>1, 
                    "maxOutputTokens"=>200, 
                    "topP"=>0.8, 
                    "topK"=>10

                    // @gpt params
                    
                    // 'max_tokens' => 60,
                    // 'top_p' => 1,
                    // 'n' => 1,
                    // 'stop' => ['\n'],
                    // 'frequency_penalty' => 0.25,
                    // 'presence_penalty' => 0.5,
                    // 'best_of' => 1
                ],
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
            // response()->json($result['choices'][0]['text']);
        } catch (RequestException $e) {
            // Handle any request exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

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
        $apiURL='localhost:8000/processdata';
        $client = new Client(['verify' => false,]);

        try {
            $response = $client->post('https://generativelanguage.googleapis.com/v1beta2/models/text-bison-001:generateText?key=AIzaSyAk-RAxYiVrqjb4dZAI_CrSxfmBX1Q0qRE', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    // 'Authorization' => 'Bearer ' . env('GOOGLE_API_KEY'),
                ],
                'json' => [

                    // @PALM params
                    
                    'prompt' =>array('text'=>'explain different parts of a computer'),
                    "temperature"=>0.7, 
                    "candidate_count"=>1, 
                    "maxOutputTokens"=>200, 
                    "topP"=>0.8, 
                    "topK"=>10

                    // @gpt params

                    // 'model' => 'davinci',
                    // 'max_tokens' => 60,
                    // 'top_p' => 1,
                    // 'n' => 1,
                    // 'stop' => ['\n'],
                    // 'frequency_penalty' => 0.25,
                    // 'presence_penalty' => 0.5,
                    // 'best_of' => 1
                ],
            ]);

            $result = json_decode($response->getBody()->getContents(),true);
            // $api_request = $client->post($apiURL, ['json' => ['data' => $result]]);
            // $responce = json_decode($api_request->getBody()->getContents(),true);
            // return $response;
            return $result['candidates'][0]['output'];
            
        } catch (RequestException $e) {
            // Handle any request exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}


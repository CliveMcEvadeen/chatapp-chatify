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
            $response = $client->post('https://generativelanguage.googleapis.com/v1beta2/models/text-bison-001:generateText', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                    'query'=>[
                        "key"=>env('GOOGLE_API_KEY'),
                    ],
                'json' => [

                    // @PALM params
                    
                    'prompt' =>array('text'=>'explain different parts of a computer'),
                    "temperature"=>0.7, 
                    "candidate_count"=>1, 
                    "maxOutputTokens"=>600, 
                    "topP"=>0.8, 
                    "topK"=>10

                ],
            ]);

            $result = json_decode($response->getBody()->getContents(),true);
           
            $response=explode(".", $result['candidates'][0]['output']);
            foreach($response as $statement){
                $LLM_response=trim($statement). ".\n";
                echo $LLM_response;
            }
            
        } catch (RequestException $e) {
            // Handle any request exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}


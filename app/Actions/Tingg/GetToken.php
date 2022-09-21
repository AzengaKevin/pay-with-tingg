<?php

namespace App\Actions\Tingg;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetToken
{
    /**
     * Retrieve authentication credential from tingg serve
     * 
     * @param array $payload
     * 
     * @throws \Exception
     * 
     * @return array
     */
    public function execute(array $payload) : array
    {

        try {

            /** @var Response */
            $response = Http::withHeaders([
                'apiKey' => $payload['client_id']
            ])->post($payload['url'], [
                'client_id' => $payload['client_id'],
                'client_secret' => $payload['client_secret'],
                'grant_type' => $payload['grant_type'],
            ]);

            dd($response->body());

            if($response->successful()){

                return $response->json();

            }else{

                throw new \Exception("Failed to retieve tingg");

            }

        } catch (\Exception $exception) {

            throw $exception;

        }
    }
}

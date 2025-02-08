<?php

namespace App\Services;

use GuzzleHttp\Client;

class FacebookService
{
    protected $client;
    protected $pixelId;
    protected $accessToken;

    public function __construct()
    {
        // Initialize the HTTP client
        $this->client = new Client();

        // Get Facebook Pixel ID and Access Token from env
        $this->pixelId = env('FACEBOOK_PIXEL_ID');
        $this->accessToken = env('FACEBOOK_ACCESS_TOKEN');
    }

    public function sendEventToFacebook(array $eventData)
    {
        // API endpoint for the Facebook Conversion API
        $url = "https://graph.facebook.com/v12.0/{$this->pixelId}/events?access_token={$this->accessToken}";

        // Send event data to Facebook using Guzzle
        $response = $this->client->post($url, [
            'json' => [
                'data' => [$eventData]
            ]
        ]);

        // Return the response body (decoded)
        return json_decode($response->getBody()->getContents(), true);
    }
}

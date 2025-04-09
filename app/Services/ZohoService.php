<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ZohoService
{
    public static function getAccessToken()
    {
        // Check if a valid access token is stored in cache
        if (Cache::has('zoho_access_token')) {
            return Cache::get('zoho_access_token');
        }

        // If not, refresh the token
        return self::refreshAccessToken();
    }

    public static function refreshAccessToken()
    {
        $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
            'refresh_token' => env('ZOHO_REFRESH_TOKEN'),
            'client_id' => env('ZOHO_CLIENT_ID'),
            'client_secret' => env('ZOHO_CLIENT_SECRET'),
            'grant_type' => 'refresh_token',
        ]);

        $data = $response->json();

        if (isset($data['access_token'])) {
            $accessToken = $data['access_token'];

            // Store the new token in cache for 55 minutes (before it expires)
            Cache::put('zoho_access_token', $accessToken, now()->addMinutes(55));

            return $accessToken;
        }

        Log::error('Failed to refresh Zoho access token', ['response' => $data]);

        return null;
    }
}

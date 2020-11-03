<?php

namespace App\Action;

use Illuminate\Support\Facades\Http;

class Hunt
{
    public $api = "https://api.producthunt.com/v1/";

    /**
     * Get a dates worth of Hunts
     *
     * @param string $date
     * @return Array
     */
    public function getDate(string $date)
    {
        $url = $this->api . "posts?day=" . $date;
        return json_decode($this->req($url), true);
    }

    /**
     * Can we follow a URL and find the response from the
     * redirected URL
     *
     * @param String $url
     * @return boolean
     */
    public function canFollowRedirect($url)
    {
        try {
            $resp = Http::get($url);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            //-- Couldn't connect to server
            return false;
        }

        //-- Server test
        return ($resp->successful());
    }

    /**
     * Make a request
     *
     * @param string $url
     * @return string
     */
    private function req($url)
    {
        //-- Check if cache exists
        $cache = storage_path('req/' . md5($url) . ".txt");
        if (!file_exists($cache)) {
            //-- If not, make request
            $response = Http::withToken(config('services.product_hunt'))->get($url);
            //-- Cache request
            $data = $response->body();
            file_put_contents($cache, $data);
        } else {
            $data = file_get_contents($cache);
        }

        //-- Return
        return $data;
    }
}

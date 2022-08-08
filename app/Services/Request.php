<?php

namespace App\Services;

class Request
{
    protected $data;

    public function __construct()
    {
        $this->data = count($_GET) ? $_GET : $_POST;
    }

    public function post($url, $headers = [])
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);

        $this->data = count($_GET) ? $_GET : $_POST;

        return curl_exec($curl);
    }

    public function to_json()
    {
        $this->data = to_json($this->data);

        return $this;
    }

    public function append($additionalRequestData)
    {
        $this->data = array_merge($this->data, $additionalRequestData);

        return $this;
    }

    public function only($keys)
    {
        $filterRequestData =  array_filter($this->data, function($key) use ($keys) {
            return in_array($key, $keys);
        }, ARRAY_FILTER_USE_KEY);

        $this->data = $filterRequestData;

        return $this;
    }
}
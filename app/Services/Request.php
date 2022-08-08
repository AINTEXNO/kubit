<?php

namespace App\Services;

class Request
{
    /**
     * @var array - данные, переданные в запрос
     */
    protected $data;

    public function __construct()
    {
        $this->data = count($_GET) ? $_GET : $_POST;
    }

    /**
     * @param $url
     * @param $headers
     * @return bool|string
     * метод, для отправки данных post-запросом
     */
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

    /**
     * @return $this
     * метод, конвертирующий массив в json-объект
     */
    public function to_json()
    {
        $this->data = to_json($this->data);

        return $this;
    }

    /**
     * @param $additionalRequestData
     * @return $this
     * метод, который добавляет данные в запрос
     */
    public function append($additionalRequestData)
    {
        $this->data = array_merge($this->data, $additionalRequestData);

        return $this;
    }

    /**
     * @param $keys
     * @return $this
     * метод, который позволяет получить из запроса определенные данные
     */
    public function only($keys)
    {
        $filterRequestData =  array_filter($this->data, function($key) use ($keys) {
            return in_array($key, $keys);
        }, ARRAY_FILTER_USE_KEY);

        $this->data = $filterRequestData;

        return $this;
    }
}
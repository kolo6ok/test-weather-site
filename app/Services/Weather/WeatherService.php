<?php


namespace App\Services\Weather;


use App\Services\Rpc\JsonRpcClient;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;

class WeatherService
{

    protected JsonRpcClient $client;

    /**
     * WeatherService constructor.
     * @param JsonRpcClient $jsonRpcClient
     */
    public function __construct(JsonRpcClient $jsonRpcClient)
    {
        $this->client = $jsonRpcClient;
    }

    /**
     * @param Carbon $date
     * @return array
     */
    public function getByDay(Carbon $date)
    {
        $result = [];

        try {
            $data = $this->client->send('weather.getByDate', ['date' => $date->format('Y-m-d')]);
            if (!array_key_exists('error',$data)){
                $result = $data['result'];
            } else {
                error_log($data['error']['message']);
            }
        } catch (GuzzleException $e) {
            error_log($e->getMessage());
        }

        return $result;
    }

    /**
     * @param int $count
     * @return array|mixed
     */
    public function getLastDay(int $count)
    {
        $result = [];

        try {
            $data = $this->client->send('weather.getHistory', ['lastDays' => $count]);
            if (!array_key_exists('error',$data)){
                $result = $data['result'];
            } else {
                error_log($data['error']['message']);
            }
        } catch (GuzzleException $e) {
            error_log($e->getMessage());
        }

        return $result;

    }
}

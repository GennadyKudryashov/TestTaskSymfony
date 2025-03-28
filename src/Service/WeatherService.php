<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class WeatherService implements WeatherServiceInterface
{
    public function __construct(
        private LoggerInterface $logger,
        private string $apiKey,
        private string $url,
        private string $returnTransfer,
        private string $timeout,
    ) {
    }

    private function getSettings(string $city){

        $settings['url'] = $this->url;
        $settings['url_raw'] = str_replace('{%CITY%}',$city,$this->url);
        $settings['returnTransfer'] = $this->returnTransfer;
        $settings['timeout'] = $this->timeout;
        return $settings;
    }

    public function getWeather(string $city): array
    {
        //TODO : 
        
        //TODO: implement http client call with curlopt from env values . also read secret values and log it in ceparate chanel of monolog;


        $this->logger->info('Start weather api call.',['url'=>$this->url,'city' => $city]);

        //$index = array_rand($messages);

        // $settings['url'] = $this->url;
        // $settings['url_raw'] = str_replace('{%CITY%}',$city,$this->url);
        // $settings['returnTransfer'] = $this->returnTransfer;
        // $settings['timeout'] = $this->timeout;

        $settings = $this->getSettings($city);
        //TODO: rewirite on HTTP client component;

        //code for curl opt;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$settings['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $settings['returnTransfer']);
        curl_setopt($ch, CURLOPT_TIMEOUT, $settings['timeout']);
        $response = curl_exec($ch);
        
        if(curl_errno($ch)) {
            $error = 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return ['error' => $error];
        }
        
        curl_close($ch);
        $data = json_decode($response, true);
        
        if(isset($data['error'])) {
            return ['error' => $data['error']['message']];
        }
        


        //Emitation of call:
        $weatherData['city'] = 'London';
        $weatherData['country'] = 'GB';
        $weatherData['temperature'] = '-65C';
        $weatherData['condition'] = 'bad';
        $weatherData['humidity'] = 'wet';
        $weatherData['wind_speed'] = 'low';
        $weatherData['last_updated'] = 'today';

        $result = $weatherData;

        //var_dump($settings);

        return $result;
    }
}
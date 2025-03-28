<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class WeatherService implements WeatherServiceInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function getWeather(string $city): string
    {
        //TODO : //TODO: implement http client call with curlopt from env values . also read secret values and log it in ceparate chanel of monolog;
    
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $this->logger->info('About to find a happy message!');

        $index = array_rand($messages);

        return $messages[$index];
    }
}
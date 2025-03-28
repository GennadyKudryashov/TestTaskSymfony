<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;
// use App\Service\WeatherService\WeatherServiceInterface;
use App\Service\WeatherServiceInterface;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather')]

    public function index(int $city, LoggerInterface $logger, WeatherServiceInterface $weather): Response //int $city
    {
        var_dump($city);
        var_dump($weather->getWeather('city'));
        //TODO: Must be implemented transformation from city name id to city name based on DB. in case APIPlatform we can do tha automatically;

       // $logger->log('mama mila ramu');
       $logger->info('We are logging! controller weather called');

       //TODO : here we must call service with weather curl; result must be cashed. responce transformed to array or made exceptions.
        // Planned Service Name is WeatherService.
        $weatherData['city'] = 'London';
        $weatherData['country'] = 'GB';
        $weatherData['temperature'] = '-65C';
        $weatherData['condition'] = 'bad';
        $weatherData['humidity'] = 'wet';
        $weatherData['wind_speed'] = 'low';
        $weatherData['last_updated'] = 'today';

        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
            'weather_data' => $weatherData
        ]);
    }
}

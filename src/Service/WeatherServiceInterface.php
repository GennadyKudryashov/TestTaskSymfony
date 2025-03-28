<?php

namespace App\Service;

interface WeatherServiceInterface
{
    public function getWeather(string $value): array;
}
# TestTaskSymfony
testTask
task for Linvinov.

text:

Tech Task Symfony Developer


Нижче наведено PHP-скрипт, який отримує дані про погоду із зовнішнього API. Ваше завдання - рефакторинг цього коду в повноцінний Symfony-додаток, дотримуючись принципів об'єктно-орієнтованого програмування та кращих практик Symfony.

<?php

function getWeatherData($city) {
    $apiKey = 'abc123weatherapikey';
    $url = "https://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$city}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
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
    
    $result = [
        'city' => $data['location']['name'],
        'country' => $data['location']['country'],
        'temperature' => $data['current']['temp_c'],
        'condition' => $data['current']['condition']['text'],
        'humidity' => $data['current']['humidity'],
        'wind_speed' => $data['current']['wind_kph'],
        'last_updated' => $data['current']['last_updated'],
    ];
    
    file_put_contents('weather_log.txt', date('Y-m-d H:i:s') . " - Погода в {$result['city']}: {$result['temperature']}°C, {$result['condition']}\n", FILE_APPEND);
    
    return $result;
}

$weatherData = getWeatherData('London');
if(isset($weatherData['error'])) {
    echo "Ошибка: " . $weatherData['error'];
} else {
    echo "Текущая погода в {$weatherData['city']}, {$weatherData['country']}:\n";
    echo "Температура: {$weatherData['temperature']}°C\n";
    echo "Состояние: {$weatherData['condition']}\n";
    echo "Влажность: {$weatherData['humidity']}%\n";
    echo "Скорость ветра: {$weatherData['wind_speed']} км/ч\n";
    echo "Последнее обновление: {$weatherData['last_updated']}\n";
}


Вимоги:

Створити програму на Symfony (використовувати останню LTS версію)

Реалізувати сервіс Weather для обробки комунікації з API

Створити контролер для надання даних про погоду через ендпоінт

Впровадити правильне керування конфігурацією для API-ключа

Додати базову обробку помилок та логування

Створити простий Twig-шаблон для відображення інформації про погоду

Використовувати використання залежностей там, де це доречно


Написати хоча б один модульний тест для вашого сервісу

Критерії оцінки
           Організація та структура коду

Правильне використання компонентів та сервісів Symfony

Обробка помилок та керування винятками

Управління конфігурацією

Поділ відповідальності

Якість коду та дотримання кращих практик

Документація та коментарі


Вимоги до здачі
Будь ласка, надайте:

Повний вихідний код

Інструкції з встановлення та налаштування

Коротке пояснення ваших рішень щодо реалізації


 Успіхів!

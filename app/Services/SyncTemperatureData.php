<?php
namespace App\Services;

use App\Models\City;
use App\Models\Temperature;
use App\Models\User;
use Illuminate\Support\Carbon;

class SyncTemperatureData
{

    public function addUsertoCity(User $user)
    {

        City::insert([
            [
                'user_id' => $user->id,
                'name' => env("CITY_1_NAME"),
                'lat' => env("CITY_1_LAT"),
                'lon' => env("CITY_1_LON"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'user_id' => $user->id,
                'name' => env("CITY_2_NAME"),
                'lat' => env("CITY_2_LAT"),
                'lon' => env("CITY_2_LON"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }

    public function processApiData(User $user)
    {

        if ($user->relationLoaded('cities')) {
            foreach ($user->cities as $city) {
                $response = callApiClient(env("WEATHER_API_URL"), 'json');

                if ($response) {

                    //calculate farenheit
                    $farenheit_amount = ($response['current']['temp'] * 9 / 5) + 32;

                    Temperature::create([
                        'user_id' => $user->id,
                        'city_id' => $city->id,
                        'temperature_celsius' => $response['current']['temp'],
                        'temperature_fahrenheit' => $farenheit_amount,
                    ]);
                }
            }
        }

    }
}

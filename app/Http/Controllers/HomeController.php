<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $test = callApiClient('https://api.openweathermap.org/data/2.5/onecall?lat=6.927079&lon=79.861244&units=metric&exclude=minutely,hourly,daily,alerts&appid=8dc9ba99c4e5fe28f4dc20edbc1848c0', 'json');
        dd($test);
        return view('home');
    }
}

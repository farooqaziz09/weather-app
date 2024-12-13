<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function fetchWeather(Request $request)
    {
        $city = $request->input('city');
        // $apiKey = env('WEATHER_API_KEY');
        $apiKey = 'e34c8f38fda849a21891c0eb3749eb6a';
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);
        $weather = $response->json();
        $tasks = Task::all();
        return view('dashboard', compact('weather', 'tasks'));
    }
    public function fetchWeatherdata(Request $request)
    {
        $city = $request->input('city');
        // $apiKey = env('WEATHER_API_KEY');
        $apiKey = 'e34c8f38fda849a21891c0eb3749eb6a';
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);
        return $response->json();
    }
    public function saveWeatherAsTask(Request $request)
    {
        $data = $this->fetchWeatherdata($request);

        Task::create([
            'title' => 'Check weather in ' . $data['name'],
            'description' => $data['weather'][0]['description'] .
                'Temperature:' . $data['main']['temp'] . '°C' .
                'Humidity: ' . $data['main']['humidity'] .
                ' Wind Speed:' . $data['wind']['speed'] .
                'Description:' . $data['weather'][0]['description'],
            'status' => 'Pending',
            'created_by' => auth()->id(),
        ]);
        return redirect()->back()->with(['message' => 'Weather saved as a task']);
    }
}

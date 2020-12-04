<?php

namespace App\Http\Controllers;

use App\Services\Weather\WeatherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteController extends Controller
{
    /**
     * @var WeatherService
     */
    private WeatherService $weatherService;

    /**
     * SiteController constructor.
     * @param WeatherService $weatherService
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Index',[

        ]);
    }

    public function getTemp(Request $request)
    {
        $result = ['errors' => [],'data' => []];

        $date = $request->get('date');

        if (empty($date)) {
            $result['errors'] = 'Пустая дата!';
        } else {
            $date = Carbon::parse($date);
            $result['data'] = $this->weatherService->getByDay($date);
        }

        return $result;
    }

    public function getLastDays(Request $request)
    {
        $result = ['errors' => [],'data' => []];

        $count = $request->get('count');

        if (empty($count)) {
            $result['errors'] = 'Пустая дата!';
        } else {
            $result['data'] = $this->weatherService->getLastDay($count);
        }

        return $result;
    }
}

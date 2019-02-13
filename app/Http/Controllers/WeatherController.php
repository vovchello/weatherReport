<?php


namespace App\Http\Controllers;


use App\Servises\WeatherServise\WeatherForecastService\WeatherForecastService;

/**
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController extends Controller
{

    /**
     * @var WeatherForecastService
     */
    private $weatherService;

    /**
     * WeatherController constructor.
     * @param $weatherService
     */
    public function __construct(WeatherForecastService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @param $datas
     * @return mixed
     */
    private function Decode($datas)
    {
        foreach($datas as $data)
        {
            $result = json_decode($data);
        }
        return $result;
    }

    /**
     * @param $name
     * @param $code
     * @return array
     */
    private function getCityArray($name, $code)
    {
        $cityParams = [
            'name' => $name,
            'code' => $code
        ];
        $city[] = (object)$cityParams;
        return $city;
    }


    /**
     * @param $name
     * @param $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($name, $code)
    {
        $city = $this->getCityArray($name,$code);
        $weather = $this->weatherService->getWeather($city,'metric');
        $weather['weather'] = $this->Decode($weather['weather']);
        return view('base.refinedReport',[
            'weather' => $weather['weather'],
            'message' => $weather['message']
        ]);
    }
}

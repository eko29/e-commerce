<?php

namespace App\Models;

//ini_set('max_execution_time', '300');
//use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Api
{
    public function __construct()
    {
        $this->rajaongkir_api_key = config('app.rajaongkir_api_key');
        $this->rajaongkir_api_type = config('app.rajaongkir_api_type');
        $this->rajaongkir_api_link = config('app.rajaongkir_api_link');
    }
    public function RajaOngkir($origin,$destination,$weight,$kurir){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->rajaongkir_api_link.'/'.$this->rajaongkir_api_type.'/cost',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'origin='.$origin.'&destination='.$destination.'&weight='.$weight.'&courier='.$kurir,
          CURLOPT_HTTPHEADER => array(
            'key: '.$this->rajaongkir_api_key,
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);
        
        // curl_close($curl);
        return json_decode($response, true);

    }
    
}

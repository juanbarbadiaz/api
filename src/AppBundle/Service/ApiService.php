<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class ApiService
{
    public function __construct()
    {

    }

    public function callApi($metodo, $url, $datos = false){

        $curl = curl_init();

        switch ($metodo)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($datos)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $datos);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($datos)
                    $url = sprintf("%s?%s", $url, http_build_query($datos));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $resultados = curl_exec($curl);

        curl_close($curl);

        return $resultados;

    }
}
<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class ComunService implements ComunServicesInterface
{
    public function __construct()
    {

    }

    public function conversorJSON($json, $salida){
        $array_datos = json_decode($json);
        $array_salida = array();

        foreach ($array_datos as $key => $value){
            foreach ($salida as $tipo){
                $array_salida[$key][$tipo] = $value[$tipo];
            }

        }

        return $array_salida;
    }
}

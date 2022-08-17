<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

interface ApiServiceInterface
{
    public function callApi($metodo, $url, $datos);

}

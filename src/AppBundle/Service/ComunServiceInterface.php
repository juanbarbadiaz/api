<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

interface ComunServiceInterface
{
    public function conversorJSON($json, $salida);

}

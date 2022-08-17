<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\ComunServiceInterface;
use AppBundle\Service\ApiServiceInterface;

class ApiController extends Controller
{

    public function callAction(Request $request, ApiServiceInterface $api)
    {
        $url = $this->container->getParameter('url');

        $query = $request->query->all();
        $post = $request->request->all();
        if($query){
            $metodo = 'GET';
            $call = $api->callApi($metodo, $url, $query);
        }
        else if($post){
            $metodo = 'POST';
            $call = $api->callApi($metodo, $url, $post);
        }
        else{
            $call = array();
            $call['error'] = 'llamada en formato incorrecto';
            $call = json_encode($call);
        }

        return new Response(json_encode($call));

    }

    public function callFoodAction(Request $request, ApiServiceInterface $api, ComunServiceInterface $comun){
        //formamos la url a la cual vamos a llamar en el api externa
        $url = $this->container->getParameter('url');
        $url = $url.'?food='.$request->get('food');
        //generamos el curl
        $call = $api->callApi('GET', $url, '');
        $array_salida = array('id','name','description');
        //convertimos ese json en un array y sacamos los datos que queremos
        $converso = $comun->conversorJSON($call,$array_salida);
        return new Response(json_encode($converso));
    }

    public function callIdAction(Request $request, ApiServiceInterface $api, ComunServiceInterface $comun){
        //formamos la url a la cual vamos a llamar en el api externa
        $url = $this->container->getParameter('url');
        $url = $url.'/'.$request->get('id');
        //generamos el curl
        $call = $api->callApi('GET', $url, '');
        //convertimos ese json en un array y sacamos los datos que queremos
        $array_salida = array('id','name','description','first_brewed','tagline','image_url');
        $converso = $comun->conversorJSON($call,$array_salida);
        return new Response(json_encode($converso));
    }
}

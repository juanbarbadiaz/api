<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\ApiService;

class ApiController extends Controller
{

    public function callAction(Request $request, ApiService $api)
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

    public function callFoodAction(Request $request, ApiService $api){
        $food = $request->get('food');
        $url = $this->container->getParameter('url');
        $url = $url.'?food='.$food;
        $call = $api->callApi('GET', $url, '');
        return new Response(json_encode($call));
    }

    public function callIdAction(Request $request, ApiService $api){
        $id = $request->get('id');
        $url = $this->container->getParameter('url');
        $url = $url.'/'.$id;
        $call = $api->callApi('GET', $url, '');
        return new Response(json_encode($call));
    }
}

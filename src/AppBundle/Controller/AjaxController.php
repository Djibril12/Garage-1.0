<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Voiture;

class AjaxController extends Controller
{
    /**
     * @Route("/get-car", name="app.ajax.get.car")
     */
    public function getcarAction(Request $request)
    {
        
        $car = $request->request->get('car');
               
        $carInfos = $this->getDoctrine()->getRepository(Voiture::class)->find($car);
          $data = (array) $carInfos;      
        //dump($carInfos);

         return new JsonResponse(['data' => json_encode($data)]);
    }
}

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
        
        $id = $request->request->get('car');
               
        $car = $this->getDoctrine()->getRepository(Voiture::class)->find($id);
        dump($car);


        $formatted = [
            'id' => $car->getId(),
            'name' => $car->getName(),
            'image' => $car->getImage()
        ];



        //$data = (array) $carInfos;
        //dump($carInfos);

         return new JsonResponse($formatted);
    }
}

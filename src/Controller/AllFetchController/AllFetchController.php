<?php

namespace App\Controller\AllFetchController;


use App\Repository\DriversRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


class AllFetchController extends AbstractController
{
    /**
     * @Route("/all", name="all")
     * @param DriversRepository $rep
     * @param SerializerInterface $serializer
     * @return Response
     */

    public function allFetcher(DriversRepository $rep, SerializerInterface $serializer) {
        $obj = $serializer->serialize($rep->findAll(), 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
      //  dump($obj);die;
        return new Response($obj, 200, ['Content-Type' => 'application/json']);
    }

    /**
    * @Route("/spec", name="specific_driver")
    */
    public function specificDriver(Request $request, DriversRepository $rep, SerializerInterface $serializer) {
        if(!empty($request->query->get('q')))
            $obj = $rep->findDriver($request->query->get('q'));
        else
            $obj = $rep->findDriver("");
        $obj = $serializer->serialize($obj, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        return new Response($obj, 200, ['Content-Type' => 'application/json']);
    }
    /**
    * @Route("/nationality", name="nat")
    */
    public function nationalityDrivers(Request $request, DriversRepository $rep, SerializerInterface $serializer){
        $obj = $rep ->findDriverOfNat($request->query->get('q'));
        $obj = $serializer->serialize($obj, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        return new Response($obj, 200, ['Content-Type' => 'application/json']);
    }
}
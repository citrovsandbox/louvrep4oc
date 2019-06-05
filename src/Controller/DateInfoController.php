<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Entity\Booking;

use App\Services\ValidatorService;

class DateInfoController extends BaseController
{
    public function __construct (ValidatorService $ValidatorService) {
        $this->validator = $ValidatorService;
    }
    /**
     * @Route("/dateisavaiable", name="dateisavaiable", methods={"POST"})
     */
    public function index(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $str_date = $data["date"];
        $state = $this->validator->bookingDate($str_date);
        if($state) {
            $res = $this->httpRes(200, "The date informations are here.", '{"dateIsEnabled":true}');
        } else {
            $res = $this->httpRes(200, "The date informations are here.", '{"dateIsEnabled":false}');
        }
        return $res;
    }
}

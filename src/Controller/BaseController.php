<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BaseController extends AbstractController
{
    public function getPostBody (Request $request) {
        $data = json_decode(
            $request->getContent(),
            true
        );
        return $data;
    }

    public function httpRes ($code, $details, $data) {
        return JsonResponse::fromJsonString('{"code":' . $code . ', "details":"' . $details . '", "data":' . $data . '}');
    }
}

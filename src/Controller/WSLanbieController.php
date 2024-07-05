<?php

namespace App\Controller;

use App\Entity\Cursos;
use App\Repository\CursosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class WSLanbieController extends AbstractController
{
    #[Route('/ws/coches', name: 'app_ws_coches', methods: 'GET')]
    public function getAll(CursosRepository $cursosRepository): JsonResponse
    {
        //Primero obtenemos todos los coches de la base de datos
        $coches = $cursosRepository->findAll();
        //Convertimos los coches a JSON
        return $this->convertToJson($coches);
    }

    private function convertToJson($object):JsonResponse
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer()];
        $serializers = new Serializer($normalizers, $encoders);
        $normalized = $serializers->normalize($object, null, array(DateTimeNormalizer::FORMAT_KEY => "Y/m/d"));
        $JsonContent = $serializers->serialize($normalized, "json");
        return JsonResponse::fromJsonString($JsonContent, 200);
    }

}

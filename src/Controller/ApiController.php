<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\ClubRepository;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index( ClubRepository $clubRepo,SerializerInterface $serializer)
    {

        $json = $serializer->serialize($clubRepo->findAll(),'json');

        return new JsonResponse($json,200,[],true);
    }
}

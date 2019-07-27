<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index()
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }
/**
     * @Route("/add", name="add", methods={"POST"})
     */

    public function add(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager){
        $compte = $serializer->deserialize($request->getContent(), Compte::class, 'json');
        $entityManager->persist($compte);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Les propriétés du compte ont été bien ajouté'
        ];
        return new JsonResponse($data, 201);
     }/**
     * @Route("/add", name="add", methods={"POST"})
     */

     public function add(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager){
        $compte = $serializer->deserialize($request->getContent(), Compte::class, 'json');
        $entityManager->persist($compte);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Les propriétés du compte ont été bien ajouté'
        ];
        return new JsonResponse($data, 201);
     }

}

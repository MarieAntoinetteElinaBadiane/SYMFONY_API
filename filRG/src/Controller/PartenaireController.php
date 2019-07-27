<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{
    /**
     * @Route("/partenaire", name="partenaire")
     */
    public function index()
    {
        return $this->render('partenaire/index.html.twig', [
            'controller_name' => 'PartenaireController',
        ]);
    }

     /**
     * @Route("/part", name="part", methods={"POST"})
     */
    public function part(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    
    {
        $par = $serializer->deserialize($request->getContent(), Partenaire::class, 'json');
        $entityManager->persist($par);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Les propriétés du partenaire ont été bien ajouté'
        ];
        return new JsonResponse($data, 201);
    }
}

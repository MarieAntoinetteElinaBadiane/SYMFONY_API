<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Compte;
use App\Entity\Partenaire;
use App\Entity\User;
use App\Entity\Operation;
use App\Repository\UserRepository;
use App\Repository\CompteRepository;

/**
     * @Route("/api")
     */
class ApplicationController extends AbstractController
{
    /**
     * @Route("/part", name="part", methods={"POST"})
     */
    public function part(Request $request, EntityManagerInterface $entityManager,UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer,ValidatorInterface $validator)
    { 
        $sms='message';
        $status='status';
        
            $values = json_decode($request->getContent());
            if(isset($values->username,$values->password)) {
                $par = $serializer->deserialize($request->getContent(), Partenaire::class,'json');
                $entityManager->persist($par);
                $entityManager->flush();
                $user = new User();
                $user->setUsername($values->username);
                $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
                $user->setRoles(["ROLE_ADMIN"]);
                $user->setNom($values->nom);
                $user->setPrenom($values->prenom);
                $user->addPartenaire($par);
                $errors = $validator->validate($user);
                if(count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500, [
                        'Content-Type' => 'application/json'
                    ]);
                } 
                $entityManager->persist($user);
                $entityManager->flush();
                $data = [
                    $status => 201,
                    $sms => 'Les propriétés du partenaire ont été bien ajouté'
                ];
                return new JsonResponse($data, 201);
            }
            $data = [
                $status => 500,
                $sms => 'Vous devez renseigner les clés username et password'
            ];
     return new JsonResponse($data, 500);
    }

    /**
     * @Route("/addcompte",name="add",methods={"POST"})
     */
    public function addcompte(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager){
        $compte = $serializer->deserialize($request->getContent(),Compte::class, 'json');
        $entityManager->persist($compte);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Les propriétés du compte ont été bien ajouté'
        ];
        return new JsonResponse($data, 201);
     }
    /**
     * @Route("/UserParteniar/{id}", name="part", methods={"POST"})
     */
    public function UserParteniar(Request $request,$id,EntityManagerInterface $entityManager,UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer,ValidatorInterface $validator)
    { 
        $sms='message';
        $status='status';
        
            $values = json_decode($request->getContent());
            if(isset($values->username,$values->password)) {
                $par =$this->getDoctrine()->getRepository(Partenaire::class)->find($id);
                $user = new User();
                $user->setUsername($values->username);
                $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
                $user->setRoles(["ROLE_USER"]);
                $user->setNom($values->nom);
                $user->setPrenom($values->prenom);
                $user->addPartenaire($par);
                $errors = $validator->validate($user);
                if(count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500, [
                        'Content-Type' => 'application/json'
                    ]);
                } 
                $entityManager->persist($user);
                $entityManager->flush();
                $data = [
                    $status => 201,
                    $sms => 'Les propriétés du partenaire ont été bien ajouté'
                ];
                return new JsonResponse($data, 201);
            }
            $data = [
                $status => 500,
                $sms => 'Vous devez renseigner les clés username et password'
            ];
            return new JsonResponse($data, 500);
      
      
    }
       /**
     * @Route("/OperationAjout/{id}/{numero}",name="OperationAjout",methods={"POST","GET"})
     */
    public function OperationAjout(Request $request,$id,$numero,UserRepository $userRepository,CompteRepository $compteRepository, EntityManagerInterface $entityManager){
        $values = json_decode($request->getContent());
         if(isset($values->username,$values->password)) {
            $ajout = new Operation();
            $par=$userRepository->find($id);
            $compte=$compteRepository->find($numero);
            $ajout->setDate(new \DateTime);
            $ajout->setMonaant($values->monaant);
            $ajout->setPartenaire($par['id']);
            $ajout->setCompt($compte['id']);
            $entityManager->persist($ajout);
            $entityManager->flush();
            $data = [
                'status' => 201,
                'message' => 'Les propriétés du compte ont été bien ajouté'
            ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
  
        
     }
 

}

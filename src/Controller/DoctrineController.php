<?php

namespace App\Controller;

use App\Document\User;
use Doctrine\MongoDB\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MongoDB;


use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\Annotation;


class DoctrineController extends Controller
{

    /**
     * @Route("/adduser", name="doctrine_adduser")
     */
    public function addUser()
    {
        $user = new User();
        $user->setEmail("hello@medium.com");
        $user->setFirstname("Marcel");
        $user->setLastname("Dupond");
        $user->setPassword(md5("123456"));
        $dm = $this->get('doctrine_mongodb')->getManager();

        $dm->persist($user);
        $dm->flush();
        return new JsonResponse(array('Status' => 'OK', 'id' => $user->getId()));
    }


    /**
     * @Route("/showallusers", name="doctrine_showallusers")
     */
    public function showAllUsers()
    {
        $listUser = $this->get('doctrine_mongodb')
            ->getRepository(User::class)
            //->findAll();
            ->findAllOrderedByName();

        //$connection = new \MongoClient();
        $m = $this->container->get('doctrine_mongodb.odm.default_connection');
        $db = $m->selectDatabase('fmt');
        //$db = $connection->user;

        $collection = $db->collectionName;


        return $this->render('doctrine/index.html.twig', [
            'controller_name' => 'DoctrineController',
            'listuser' => $listUser

        ]);
    }
}

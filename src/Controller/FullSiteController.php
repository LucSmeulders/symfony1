<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FullSiteController extends AbstractController
{
    private $clients = [
        'Code Code Code' => 'To the point',
        'Mildred Pigeon Associates' => 'Sounds Professional',
        'Coding Schmoding' => 'Silly',
        'Pigeon and Co' => 'Classic',
        'Kowalski Unlimited' => 'Bold',
        'Pigeon of Wales' => 'Geographical',
    ];

    private function _randomClient() {
        $randomIndex = array_rand($this->clients);
        $client = [
                    'name' => $randomIndex,
                    'quote' => $this->clients[$randomIndex]
                    ];
        return $client;
    }

    public function home()
    {
        return $this->render('home.html.twig', [
            'random_client' => $this->_randomClient(),
            'page' => 'home',
        ]);
    }

    public function clients()
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findAll();


//        $client = new Client();
//        $client->setName("Jan Janssen");
//        $client->setDescription("123");
//        $client->getScore(15);

//        $entityManager = $this->getDoctrine()->getManager();
        return $this->render('clients.html.twig', [
            'clients' => $clients,
            'page' => 'clients',
        ]);
    }

    public function clientnew()
    {
        $request = Request::createFromGlobals();
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        $score = $request->request->get('score');

        if(empty($name) || empty($description)){
            return $this->render('clientnew.html.twig', [
                'page' => 'clientnew',
            ]);

        } else {
            $client = new Client();
            $client->setName($name);
            $client->setDescription($description);
            $client->setScore(strval($score));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $repository = $this->getDoctrine()->getRepository(Client::class);
            $clients = $repository->findAll();
            return $this->render('clients.html.twig', [
                'clients' => $clients,
                'page' => 'clients',
            ]);

        }

    }


    public function contact()
    {
        return $this->render('contact.html.twig', [
            'random_client' => $this->_randomClient(),
            'page' => 'contact',
        ]);
    }

    public function client($id)
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $client = $repository->find($id);
        return $this->render('client.html.twig', [
            'client' => $client,
            'page' => 'clients',
        ]);
    }

    public function updateclient($id)
    {
        $request = Request::createFromGlobals();
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        $score = $request->request->get('score');
        $updated = $request->request->get('updated');
        if($updated == "YES"){
            $repository = $this->getDoctrine()->getRepository(Client::class);
            $client = $repository->find($id);

            $client->setName($name);
            $client->setDescription($description);
            $client->setScore(strval($score));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $repository = $this->getDoctrine()->getRepository(Client::class);
            $clients = $repository->findAll();
            return $this->render('clients.html.twig', [
                'clients' => $clients,
                'page' => 'clients',
            ]);
        }else {
            $repository = $this->getDoctrine()->getRepository(Client::class);
            $client = $repository->find($id);
            return $this->render('updateclient.html.twig', [
                'client' => $client,
                'page' => 'clients',
            ]);
        }
    }
    public function deleteclient($id)
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $client = $repository->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($client);
        $entityManager->flush();

        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findAll();
        return $this->render('clients.html.twig', [
            'clients' => $clients,
            'page' => 'clients',
        ]);
    }
}

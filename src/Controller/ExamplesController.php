<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamplesController extends AbstractController
{
    public function index()
    {
        return $this->render('examples/index.html.twig');
    }
}

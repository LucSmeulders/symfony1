<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyTemplateController extends AbstractController
{
    public function number()
    {
        return $this->render('lucky/fixed.html.twig');
    }

    public function random()
    {
        $number = - random_int(0, 100);

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

    public function numberLogic()
    {
        $number = - random_int(0, 100);

        return $this->render('lucky/number_logic.html.twig', [
            'number' => $number,
        ]);
    }

    public function moreNumbers()
    {
        $numbers = [12,3325,67,8];

        return $this->render('lucky/more_numbers.html.twig', [
            'numbers' => $numbers,
        ]);
    }

    public function forced(int $number)
    {
        return $this->render('lucky/number_forced.html.twig', [
            'number' => $number,
        ]);
    }

    public function forcedPlus(int $number, int $secondNumber)
    {
        return $this->render('lucky/number_forced_plus.html.twig', [
            'number' => $number,
            'secondNumber' => $secondNumber,
        ]);
    }

    public function numberIncludes()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number_includes.html.twig', [
            'number' => $number,
        ]);
    }

    public function numberExtends()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number_extends.html.twig', [
            'number' => $number,
        ]);
    }
}

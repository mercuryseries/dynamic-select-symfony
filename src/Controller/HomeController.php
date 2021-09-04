<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $form = $this->createFormBuilder()
            ->add('name')
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name'
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name'
            ])
            ->getForm();

        return $this->renderForm('home.html.twig', compact('form'));
    }
}

<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
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
                'placeholder' => 'Choose a country',
                'class' => Country::class,
                'query_builder' => fn (CountryRepository $countryRepository) =>
                $countryRepository->findOrderedByAscNameQueryBuilder(),
                'choice_label' => 'name'
            ])
            ->add('city', EntityType::class, [
                'placeholder' => 'Choose a city',
                'disabled' => true,
                'class' => City::class,
                'query_builder' => fn (CityRepository $cityRepository) =>
                $cityRepository->findOrderedByAscNameQueryBuilder(),
                'choice_label' => 'name'
            ])
            ->getForm();

        return $this->renderForm('home.html.twig', compact('form'));
    }
}

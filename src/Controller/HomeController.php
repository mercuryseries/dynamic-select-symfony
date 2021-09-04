<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $builder = $this->createFormBuilder();

        $builder
            ->add('name')
            ->add('country', EntityType::class, [
                'placeholder' => 'Choose a country',
                'class' => Country::class,
                'query_builder' => fn (CountryRepository $countryRepository) =>
                $countryRepository->findOrderedByAscNameQueryBuilder(),
                'choice_label' => 'name'
            ]);

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();

                $data = $event->getData();

                $country = $data->getCountry();
                $cities = null === $country ? [] : $country->getCities();

                $form->add('city', EntityType::class, [
                    'class' => City::class,
                    'placeholder' => 'Choose a city',
                    'choices' => $cities,
                ]);
            }
        );

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd('hello');
        }

        return $this->renderForm('home.html.twig', compact('form'));
    }
}

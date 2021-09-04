<?php

namespace App\Controller;

use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CityRepository $cityRepository, CountryRepository $countryRepository): Response
    {
        dd($cityRepository->findAll(), $countryRepository->findAll());

        return $this->render('home.html.twig');
    }
}

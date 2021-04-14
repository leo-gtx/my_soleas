<?php

namespace App\Controller;

use App\Repository\CardSectionRepository;
use App\Repository\ClientRepository;
use App\Repository\PortfolioRepository;
use App\Repository\SectionRepository;
use App\Repository\SettingRepository;
use App\Repository\TeamRepository;
use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(SettingRepository $settingRepository, ClientRepository $clientRepository, TeamRepository $teamRepository,  TestimonialRepository $testimonialRepository, PortfolioRepository $portfolioRepository, CardSectionRepository $cardSectionRepository, SectionRepository $sectionRepository): Response
    {
        $section = $sectionRepository->findOneBy(['isProduct'=> false]);
        $products = $sectionRepository->findBy(['isProduct'=> true]);
        $service = $cardSectionRepository->findOneBy(['title'=> 'Services']);
        $portfolios = $portfolioRepository->findAll();
        $testimonials = $testimonialRepository->findAll();
        $team = $teamRepository->findAll();
        $clients = $clientRepository->findAll();
        $setting = $settingRepository->findAll()[0];
        return $this->render('default/index.html.twig', [
            'section' => $section,
            'service' => $service,
            'features' => $products,
            'portfolios'=> $portfolios,
            'testimonials' => $testimonials,
            'team' => $team,
            'clients' => $clients,
            'setting' => $setting
        ]);
    }
}

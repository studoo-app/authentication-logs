<?php

namespace App\Controller;

use App\Repository\LogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(LogRepository $repository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'logs' => $repository->findAll(),
        ]);
    }
}

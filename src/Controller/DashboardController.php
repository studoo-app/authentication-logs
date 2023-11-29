<?php

namespace App\Controller;

use App\Repository\LogRepository;
use App\Service\LogAuditService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

    public function __construct(
        private readonly LogAuditService $service
    )
    {
    }

    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(): Response
    {
        $this->service->getLogs();
        return $this->render('dashboard/index.html.twig', [
            'logs' => $this->service->getLogs(),
        ]);
    }
}

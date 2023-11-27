<?php

namespace App\Service;

use App\Entity\Log;
use Doctrine\ORM\EntityManagerInterface;

class LogAuditService
{


    public function __construct(
        private readonly EntityManagerInterface $manager
    )
    {
    }

    public function logSuccess(string $identifier,string $clientIp): void
    {
        $trace = new Log(null,$identifier,Log::SUCCESS,"Authenticated successfully",$clientIp);
        $this->save($trace);
    }

    public function logFailure(string $identifier, string $message,string $clientIp): void
    {
        $trace = new Log(null,$identifier,Log::FAIL,$message,$clientIp);

        $this->save($trace);
    }

    private function save(Log $log): void
    {
        $this->manager->persist($log);
        $this->manager->flush();
    }

}
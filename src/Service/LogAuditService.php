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

    public function logSuccess(string $identifier): void
    {
        $trace = new Log(null,$identifier,Log::SUCCESS,"Authenticated successfully");
        $this->save($trace);
    }

    public function logFailure(string $identifier, string $message): void
    {
        $trace = new Log(null,$identifier,Log::FAIL,$message);
        $this->save($trace);
    }

    private function save(Log $log): void
    {
        $this->manager->persist($log);
        $this->manager->flush();
    }

}
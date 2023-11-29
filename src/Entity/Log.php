<?php

namespace App\Entity;

use App\Repository\LogRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log
{
    const SUCCESS = "SUCCESS";
    const FAIL = "FAIL";

    private ?string $user = null;

    private ?string $status = null;

    private ?string $message = null;

    private ?string $clientIp = null;


    /**
     * @param int|null $id
     * @param string|null $user
     * @param string|null $status
     * @param string|null $message
     */
    public function __construct(?string $user, ?string $status, ?string $message,?string $clientIp)
    {
        $this->user = $user;
        $this->status = $status;
        $this->message = $message;
        $this->clientIp = $clientIp;
    }

    public static function buildFromLog(array $array){
        return new self($array["user"],$array["status"],$array["message"],$array["clientIp"]);
    }


    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getClientIp(): ?string
    {
        return $this->clientIp;
    }

    public function setClientIp(?string $clientIp): void
    {
        $this->clientIp = $clientIp;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

}

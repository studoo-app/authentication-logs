<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    public function __construct(
        private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
    }

    public function loadUsers(ObjectManager $manager): void
    {

        $raw = [
            ["email"=>"admin@mail.dev","password"=>"password","is_admin"=>true],
            ["email"=>"michel@test.com","password"=>"password","is_admin"=>false]
        ];

        foreach($raw as $data){
            $user = new User();
            $user->setEmail($data["email"]);
            $user->setPassword($this->hasher->hashPassword($user,$data["password"]));
            $user->setRoles($data["is_admin"] ? ["ROLE_ADMIN"] : ["ROLE_USER"]);
            $manager->persist($user);
        }

        $manager->flush();
    }
}

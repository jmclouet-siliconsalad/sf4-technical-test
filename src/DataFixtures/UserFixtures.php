<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUserName("JM");
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, "stadline"));
        $manager->persist($user);

        $user2 = new User();
        $user2->setUserName("JM2");
        $user2->setPassword($this->userPasswordEncoder->encodePassword($user2, "stadline"));
        $manager->persist($user2);

        $manager->flush();
    }
}

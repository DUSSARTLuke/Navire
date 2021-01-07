<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

  private $passwordEncoder;


  public function load(ObjectManager $manager)
  {
    $user = new User();
    // ...

    $user->setPassword($this->passwordEncoder->encodePassword($user, 'the_new_password'));
  }
}

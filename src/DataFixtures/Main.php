<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Artist;
use DateTimeImmutable;
use App\Entity\PieceOfArt;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Main extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        
        // je crée un user admin pour gérer le back office de l'administration du site
        $user = new User();
        $user->setUsername('thierry74')
            ->setPassword($this->encoder->encodePassword($user, 'thierry1234'))
            ->setRoles(['ROLE_ADMIN'])
            ->setFirstname('thierry')
            ->setName('Malherbe')
            ;
        $manager->persist($user);
        $manager->flush();
        $manager->flush();

        // je simule 4 évènements

        for ($e = 0; $e < 4; $e++) {
            $event = new Event();
            $event->setName($faker->userName)
            ->setDate(new DateTimeImmutable($faker->date($format = 'Y-m-d', $max = 'now')));
            
            $manager->persist($event);
            $manager->flush();
        }

        // je simule 6 users (clients)

        for ($u = 0; $u < 6; $u++) {
            $user = new User();
            $user->setUsername($faker->userName)
            ->setPassword($this->encoder->encodePassword($user, '123456'))
            ->setRoles(['ROLE_USER'])
            ->setFirstname($faker->firstName($gender = null))
            ->setName($faker->lastName);
            
            $manager->persist($user);
            $manager->flush();
        }

        // je simule 8 artistes

        for ($a = 0; $a < 8; $a++) {
            $artist = new Artist();
            $artist->setName($faker->lastName)
            ->setFirstname($faker->firstName($gender = null))
            ->setNationality($faker->countryCode)
            ->setDescription($faker->realText(250,2));
            $manager->persist($artist);
            $manager->flush();
        }

        // je simule 25 oeuvres

        for ($p = 0; $p < 25; $p++) {
            $pieceOfArt = new PieceOfArt();
            $pieceOfArt->setName($faker->lastName)
            ->setDescription($faker->realText(250,2))
            ->setDate(new DateTimeImmutable($faker->date($format = 'Y-m-d', $max = 'now')))
            ->setPhoto("https://picsum.photos/seed/". rand(0,5000) ."/800/400")
            ->setArtist($manager->getRepository(Artist::class)->find(rand(1,8)));
            $manager->persist($pieceOfArt);
            $manager->flush();
        }
    }
}

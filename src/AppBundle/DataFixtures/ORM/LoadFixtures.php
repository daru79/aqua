<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Nelmio\Alice\Fixtures;class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(__DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
            );
    }

    public function genus()
    {
        $genera = [
            'Daru',
            'Maru',
            'Puzel',
            'Pola',
            'Lena',
            'Dżasta',
            'Sztefan',
            'Bąbel',
            'Piło',
            'Mamaryna',
            'Mem',
            'Dzi-na-na',
            'Dzije'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }
}
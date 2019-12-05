<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Product;
use App\DataFixtures\ProductFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;



class ProductFixtures extends Fixture
{

    public function load(ObjectManager $manager)
{

    $faker = Factory::create();

    for ($i = 1; $i <= 10; $i++) {
        $product = new Product();

        $product->setName($faker->name())
                ->setPrice($faker->randomNumber(2))
                ->setDescription($faker->text(150))
                ->setCreatedAt($faker->dateTimeThisYear());

        $manager->persist($product);
    }

    $manager->flush();
}
}
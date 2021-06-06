<?php
// src/Factory\CategoryFactory.php
namespace App\Factory;
use App\Entity\Emploi;
use App\Entity\Immo;
use App\Entity\Automobile;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFactory
{
    public static function createNewFactoryList(array $data)
    {
        $newsletterManager = new NewsletterManager();

        // ...

        return $newsletterManager;
    }
}

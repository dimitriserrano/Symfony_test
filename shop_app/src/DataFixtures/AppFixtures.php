<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadProduct($manager);
        $this->loadContact($manager);

        $manager->flush();
    }

    private function loadProduct(ObjectManager $manager)
    {
        foreach ($this->getProductData() as [$name, $picture, $description, $promo]) {
            $product = new Product();
            $product->setname($name);
            $product->setpicture($picture);
            $product->setdescription($description);
            $product->setpromo($promo); 
            $product->setcreated(new \DateTime());
            $manager->persist($product);
        }
        $manager->flush();
    }

    private function loadContact(ObjectManager $manager)
    {
        foreach ($this->getContactData() as [$email, $subject, $message]) {
            $contact = new Contact();
            $contact->setemail($email);
            $contact->setsubject($subject);
            $contact->setmessage($message);
            $contact->setcontactDate(new \DateTime());
            $contact->setcreated(new \DateTime());
            $manager->persist($contact);
        }
        $manager->flush();
    }

    private function getContactData(): array
    {
        return [
            ['dimitri@shop.fr', 'achat', 'zehnfjihbéziefbihzebfhzbefbezhfbhzbfhzebhfbz'],
            ['jean@shop.fr', 'achat', 'fbhuezbfhubezhufbhzebfhbzehbfh'],
        ];
    }

    private function getProductData(): array
    {
        return [
            ['Vélo', 'https://images.unsplash.com/photo-1605272652001-c1971601e75e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Nnx8dmVsb3xlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60', 'Un super vélo trop super t\'as vue', True],
            ['Voiture', 'https://images.unsplash.com/photo-1593705925813-9088413ff456?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1352&q=80', 'Voiture ancienne style américiane', False],
        ];
    }
}

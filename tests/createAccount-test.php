<?php
use App\Entity\User;

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Créer un User
$User = new \App\UserStory\CreateAccount($entityManager);
try{
    $User->execute("test","test5@test","mdptest1");

}catch (\Exception $e){
    echo $e->getMessage();
}

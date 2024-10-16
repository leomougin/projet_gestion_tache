<?php

namespace App\UserStory;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class CreateAccount
{
    private EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        // L'entityManager est injecté par dépendance
        $this->entityManager = $entityManager;
    }
    // Cette méthode permettra d'éxécuter la user story
    public function execute(string $pseudo, string $email, string $password): User
    {
        $AccountRepository = $this->entityManager->getRepository(User::class);

        // Vérifier que les données sont présentes ( pas vide )
        // Si tel n'est pas le cas alors, lancer une exception
        if(empty($pseudo)||empty($email)||empty($password)){
            throw new \Exception("Tout les champs sont obligatoires");
        }

        // Vérifier si l'email est valide
        // Si tel n'est pas le cas alors, lancer une exception
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \Exception("L'adresse email n'est pas valide");
        }

        // Vérifier si le pseudo est entre 2 et 50 caractères
        // Si tel n'est pas le cas alors, lancer une exception
        if(strlen($pseudo) < 2 || strlen($pseudo) > 50){
            throw new \Exception("La longueur du pseudo est invalide");
        }

        // Vérifier si le mot de passe est sécurisé
        // Si tel n'est pas le cas alors, lancer une exception
        // Juste la vérification de la longueur du MDP >= 8
        if(strlen($password)<8){
            throw New \Exception("Le mot de passe doit faire au moins 8 caractères.");
        }

        // Vérifier l'unicité de l'email
        // Si tel n'est pas le cas alors, lancer une exception
        if ($AccountRepository->findOneBy(['email'=>$email])) {
            throw new \Exception("L'email choisis est déjà existant");
        }


        // Insérer les données dans la base de donnée
        // 1. Hasher le mot de passe
        $passwordHash= password_hash($password, PASSWORD_DEFAULT);

        // 2. Créer une instance de la classe User

        $user = new User(); // Setters
        $user->setPseudo($pseudo);
        $user->setEmail($email);
        $user->setPassword($passwordHash);

        // 3. Persiste l'instance en utilisant l'entityManager

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Envoie de l'email de confirmation
        echo "Un email de confirmation a été envoyé à l'utilisateur";

        // Return de l'utilisateur créer
        return $user;

    }

}
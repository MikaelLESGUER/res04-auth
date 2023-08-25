<?php

class AuthController extends AbstractController {
    
    private UserManager $userManager;
    
    public function __construct() 
    {
        // session_start();
        $this->userManager = new UserManager(); // Assurez-vous que vous instanciez le UserManager ici
    }
    
    // Ajoutez ici les méthodes pour gérer l'authentification
    
    /* Pour la page d'inscription */  
    public function register() : void  
    {  
        // render la page avec le formulaire d'inscription
        $this->render("register", []);
    }  
      
    /* Pour vérifier l'inscription */  
    public function checkRegister() : void  
    {  
        if (isset($_POST["formName"]) && $_POST["formName"] === "registerForm") {
        // Récupérer les champs du formulaire
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Chiffrer le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Appeler le manager pour créer l'utilisateur en base de données
        $newUser = new User(null, $username, $email, $hashedPassword);
        $createdUser = $this->userManager->createUser($newUser);
        
        // Ajoutez cette ligne pour déboguer
        var_dump($createdUser);

        // Connecter l'utilisateur
        if ($createdUser) {
            $_SESSION["user_id"] = $createdUser->getId();
        }

        // Rediriger vers l'accueil
        header('Location: /res04-auth/');
    } else {
        // Rediriger vers la page de création de compte
        header('Location: /res04-auth/creer-un-compte');
    }
        // vérifier que le formulaire a été soumis  
        // récupérer les champs du formulaire    
        // chiffrer le mot de passe    
    	// appeler le manager pour créer l'utilisateur en base de données   
    	// connecter l utilisateur    
    	// le renvoyer vers l'accueil
    }  
      
    /* Pour la page de connexion */  
    public function login() : void  
    {  
        // render la page avec le formulaire de connexion
        $this->render("login", []);
    }  
      
    /* Pour vérifier la connexion */  
    public function checkLogin() : void  
{  
    if (isset($_POST["formName"]) && $_POST["formName"] === "loginForm") {
        // Récupérer les champs du formulaire
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Utiliser le manager pour vérifier si un utilisateur avec cet email existe
        $user = $this->userManager->getUserByEmail($email);
        
        // Ajoutez cette ligne pour déboguer
        var_dump($user);

        // Si un utilisateur avec cet email existe
        if ($user) {
            // Vérifier le mot de passe
            if (password_verify($password, $user->getPassword())) {
                // Connecter l'utilisateur
                $_SESSION["user_id"] = $user->getId();
                
                // Rediriger vers l'accueil
                header('Location: /res04-auth/');
            } else {
                // Rediriger vers la page de connexion avec une erreur
                header('Location: /res04-auth/connexion?error=invalid_password');
            }
        } else {
            // Rediriger vers la page de connexion avec une erreur
            header('Location: /res04-auth/connexion?error=user_not_found');
        }
    } else {
        // Rediriger vers la page de connexion
        header('Location: /res04-auth/connexion');
    }
        // vérifier que le formulaire a été soumis  
        // récupérer les champs du formulaire    
        // utiliser le manager pour vérifier si un utilisateur avec cet email existe    
        // si il existe, vérifier son mot de passe        
    	    // si il est bon, connecter l'utilisateur        
    	    // si il n'est pas bon renvoyer sur la page de connexion    
        // si il n'existe pas renvoyer vers la page de connexion
    }
}

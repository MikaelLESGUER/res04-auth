<?php  
 
class Router {
    
  private ShopController $ctrl;  
  private AuthController $auth;
  
    public function __construct()  
    {  
        $this->ctrl = new ShopController();  
        $this->auth = new AuthController(); 
    }
    
    private function splitRouteAndParameters(string $route) : array  
{  
    $routeAndParams = [];  
    $routeAndParams["route"] = null;  
    $routeAndParams["categorySlug"] = null;  
    $routeAndParams["productSlug"] = null;  
  
    if(strlen($route) > 0) 
    {  
        $tab = explode("/", $route);  
  
        if($tab[0] === "categories") 
        {  
            $routeAndParams["route"] = "categories";
            if(isset($tab[1]))
            {
                $routeAndParams["categorySlug"] = $tab[1];
            }  
        }  
        else if($tab[0] === "produits") 
        {  
            $routeAndParams["route"] = "produits"; 
            if(isset($tab[1]))
            {
                $routeAndParams["productSlug"] = $tab[1];  
            }  
        }  
        else if($tab[0] === "creer-un-compte") 
        {  
            $routeAndParams["route"] = "creer-un-compte";
        }  
        else if($tab[0] === "check-creer-un-compte") 
        {  
            $routeAndParams["route"] = "check-creer-un-compte";
        }  
        else if($tab[0] === "connexion") 
        {  
            $routeAndParams["route"] = "connexion";
        }  
        else if($tab[0] === "check-connexion") 
        {  
            $routeAndParams["route"] = "check-connexion";
        }
        else if($tab[0] === "deconnexion")
        {
            $routeAndParams["route"] = "deconnexion";
        }
    }  
    else  
    {  
        $routeAndParams["route"] = "";  
    }  
  
    return $routeAndParams;  
}
    
    public function checkRoute(string $route) : void  
    {  
        $routeTab = $this->splitRouteAndParameters($route);
        
        // var_dump($routeTab);
        // die;
      
        if ($routeTab["route"] === "") 
        { 
            // Appeler la méthode du contrôleur pour afficher la liste des catégories
            $this->ctrl->categoriesList();
        } 
        else if ($routeTab["route"] === "produits" && $routeTab["productSlug"] === null)
        { 
            // Appeler la méthode du contrôleur pour afficher la liste des produits
            $this->ctrl->productsList();
        } 
        else if ($routeTab["route"] === "categories" && !empty($routeTab["categorySlug"]))
        { 
            // Appeler la méthode du contrôleur pour afficher les produits d'une catégorie 
            $this->ctrl->productsInCategory($routeTab["categorySlug"]);
        } 
        else if ($routeTab["route"] === "produits" && !empty($routeTab["productSlug"]))
        { 
            // Appeler la méthode du contrôleur pour afficher le détail d'un produit 
            $this->ctrl->productDetails($routeTab["productSlug"]);
        }
        else if ($routeTab["route"] === "creer-un-compte") // condition pour afficher la page du formulaire d'inscription
        {
            $this->auth->register();
        }
        else if ($routeTab["route"] === "check-creer-un-compte") // condition pour l'action du formulaire d'inscription
        {
            $this->auth->checkRegister();
        }
        else if ($routeTab["route"] === "connexion") // condition pour afficher la page du formulaire de connexion
        {
            $this->auth->login();
        }
        else if ($routeTab["route"] === "check-connexion") // condition pour l'action du formulaire de connexion
        {
            $this->auth->checkLogin();
        }
        else if ($routeTab["route"] === "deconnexion") 
        {
        
            $this->auth->logout();
        }
    
    }

            // else
            // {
            //     header("Location: /"); // Redirige vers la page d'accueil
            //     exit;
            // }
    
        // if() // condition(s) pour envoyer vers la home  
        // {  
        //     // appeler la méthode du controlleur pour afficher la home  
        // }  
        // else if() // condition(s) pour envoyer vers la liste des produits  
        // {  
        //     // appeler la méthode du controlleur pour afficher les produits  
        // }  
        // else if() // condition(s) pour envoyer vers la liste des produits d'une catégorie  
        // {  
        //     // appeler la méthode du controlleur pour afficher les produits d'une catégorie  
        // }  
        // else if() // condition(s) pour envoyer vers le détail d'un produit  
        // {  
        //     // appeler la méthode du controlleur pour afficher le détail d'un produit  
        // }  
    
}
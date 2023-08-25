<?php  
 
class ShopController extends AbstractController {  
  
    private ProductManager $pm;  
    private CategoryManager $cm;  
  
    public function __construct()  
    {  
        $this->pm = new ProductManager();  
        $this->cm = new CategoryManager(); 
    }  
  
    /* Pour la route de la home */  
    public function categoriesList() : void  
    {  
        // $categories = []; // à remplacer par un appel au manager pour récupérer la liste des catégories
        $categories = $this->cm->getAllCategories(); // Utilisation du CategoryManager
      
        $this->render("index", [  
            "categories" => $categories  
        ]);  
    }
    
    /* Pour la route /categories/:slug-categorie */  
    public function productsInCategory(string $categorySlug) : void  
    {  
        // $products = []; // à remplacer par un appel au manager pour récupérer la liste des produits d'une catégorie  
        $products = $this->pm->getProductsByCategorySlug($categorySlug); // Utilisation du ProductManager
        $category = $this->cm->getCategoryBySlug($categorySlug);
        
        $this->render("category", [  
            "products" => $products,
            "categoryName" => $category->getName()
        ]);  
    }
    
    /* Pour la route /categories/produits */  
    public function productsList() : void  
    {  
        // $products = []; // à remplacer par un appel au manager pour récupérer la liste de tous les produits 
        $products = $this->pm->getAllProducts(); // Utilisation du ProductManager
      
        $this->render("products", [  
            "products" => $products  
        ]);  
    }
    
    /* Pour la route /produits/:slug-produit */  
    public function productDetails(string $productSlug) : void  
    {  
        // $product = []; // à remplacer par un appel au manager pour récupérer les informations d'un produit  
        $product = $this->pm->getProductBySlug($productSlug);   // Utilisation du ProductManager
      
        $this->render("product", [  
            "product" => $product  
        ]);  
    }
    
}
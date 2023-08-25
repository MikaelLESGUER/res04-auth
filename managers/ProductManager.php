<?php  
 
class ProductManager extends AbstractManager 
{  
    public function getAllProducts() : array  
    {  
        $products = [];
        
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product(null, "", "", "",0);
            $product->setId($row['id']);
            $product->setName($row['name']);
            $product->setSlug($row['slug']);
            $product->setDescription($row['description']);
            $product->setPrice($row['price']);
            $products[] = $product;
        }
      
        return $products;  
    }  
      
    public function getProductBySlug(string $productSlug) : ?Product  
    {  
        $query = "SELECT * FROM products WHERE slug = :slug";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':slug', $productSlug, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            return null;
        }
      
        $product = new Product(null, "", "", "", 0);
        $product->setId($row['id']);
        $product->setName($row['name']);
        $product->setSlug($row['slug']);
        $product->setDescription($row['description']);
        $product->setPrice($row['price']);
      
        return $product;  
    }
    
    public function getProductsByCategorySlug(string $categorySlug) : array  
    {  
        $products = [];
        
        $query = "SELECT p.* FROM products p INNER JOIN products_categories pc ON p.id = pc.products_id INNER JOIN categories c ON pc.category_id = c.id WHERE c.slug = :slug";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':slug', $categorySlug, PDO::PARAM_STR);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product(null, "", "", "", 0);
            $product->setId($row['id']);
            $product->setName($row['name']);
            $product->setSlug($row['slug']);
            $product->setDescription($row['description']);
            $product->setPrice($row['price']);
            $products[] = $product;
        }
      
        return $products;  
    }
//       public function getAllProducts() : array  
// {  
//     $list = [];  
  
//     return $list;  
// }  
  
// public function getProductBySlug(string $productSlug) : Product  
// {  
//     $product = new Product();  
  
//     return $product;  
// }  
  
// public function getProductsByCategorySlug(string $categorySlug) : array  
// {  
//     $list = [];  
  
//     return $list;  
// }
}
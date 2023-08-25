<?php  
 
class CategoryManager extends AbstractManager 
{
    public function getAllCategories() : array  
    {  
        $categories = [];
        
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category(null, "", "", "");
            $category->setId($row['id']);
            $category->setName($row['name']);
            $category->setSlug($row['slug']);
            $category->setDescription($row['description']);
            $categories[] = $category;
        }
      
        return $categories;  
    }  
      
    public function getCategoryBySlug(string $slug) : ?Category  
    {  
        $query = "SELECT * FROM categories WHERE slug = :slug";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            return null;
        }
      
        $category = new Category(null, "", "", "");
        $category->setId($row['id']);
        $category->setName($row['name']);
        $category->setSlug($row['slug']);
        $category->setDescription($row['description']);
      
        return $category;  
    } 
    //   public function getAllCategories() : array  
    // {  
    //     $list = [];  
      
    //     // Pour accéder à la base de données utilisez $this->db  
      
    //     return $list;  
    // }  
      
    // public function getCategoryBySlug() : Category  
    // {  
    //     $category = new Category();  
      
    //     // Pour accéder à la base de données utilisez $this->db  
      
    //     return $category;  
    // }
}
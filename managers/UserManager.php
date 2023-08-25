<?php  
 
class UserManager extends AbstractManager {

    // public function getUserByEmail(string $email) : ?User  
    // {  
    //     $query = "SELECT * FROM users WHERE email = :email";  
    //     $params = [":email" => $email];  
    //     $result = $this->db->selectOne($query, $params);  
    
    //     if ($result) {
    //         return new User(
    //             $result['id'],
    //             $result['username'],
    //             $result['email'],
    //             $result['password']
    //         );
    //     }
    
    //     return null;
    // }
    
    public function getUserByEmail(string $email): ?User
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['password']
        );
    }

    public function createUser(User $user) : User
    {
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $values = [$user->getUsername(), $user->getEmail(), $user->getPassword()];

        $stmt = $this->db->prepare($query);
        $success = $stmt->execute($values);

        if ($success) {
            $user->setId($this->db->lastInsertId());
            return $user; // Retourne l'objet User nouvellement créé
        } else {
            return null; // Ou une gestion d'erreur appropriée
        }
    }

    // public function createUser(User $user): bool
    // {
    //     $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
    //     $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
    //     $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);

    //     return $stmt->execute();
    // }
}

// class UserManager extends AbstractManager {  
  
//     public function getUserByEmail(string $email) : User  
//     {  
//         // Pour accéder à la base de données utilisez $this->db
//         $query = "SELECT * FROM users WHERE email = :email";
//         $stmt = $this->db->prepare($query);
//         $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//         $stmt->execute();
    
//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
//         if (!$row) {
//             return null;
//         }
    
//         $user = new User();
//         $user->setId($row['id']);
//         $user->setEmail($row['email']);
//         $user->setPassword($row['password']);
    
//         return $user;
    
//     }  
  
//     public function createUser(User $user) : User  
//     {  
//         // Pour accéder à la base de données utilisez $this->db 
//         $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
//         $stmt = $this->db->prepare($query);
//         $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
//         $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
//         $stmt->execute();

//         $user->setId($this->db->lastInsertId());

//         return $user;
//     }  
  
// }
<?php
class User {
    private $connection;
    private $table = "users";

    public function __construct($db) {
        $this->connection = $db;
    }

    public function getUsersWithLimit($start, $limit, $search = '', $sortColumn = 'username', $sortOrder = 'ASC') {
        $search = "%$search%";
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE username LIKE :search OR email LIKE :search 
                  ORDER BY $sortColumn $sortOrder 
                  LIMIT :start, :limit";
    
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':search', $search);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getTotalUsers($search = '') {
        $search = "%$search%";
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE username LIKE :search OR email LIKE :search";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':search', $search);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function register($username, $email, $password, $avatar) {
        $query = "INSERT INTO " . $this->table . " (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        $stmt->bindParam(':avatar', $avatar);

        return $stmt->execute();
    }

    public function login($usernameOrEmail, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :usernameOrEmail OR email = :usernameOrEmail LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':usernameOrEmail', $usernameOrEmail);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllUsers() {
        $query = "SELECT id, username, email, avatar FROM " . $this->table;
        return $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateUser($id, $username, $email, $avatar = null) {
       
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email AND id != :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        if ($stmt->fetchColumn() > 0) {
            return ['success' => false, 'message' => 'Email already exists'];
        }
    
        $query = "UPDATE " . $this->table . " SET username = :username, email = :email" .
                 ($avatar ? ", avatar = :avatar" : "") .
                 " WHERE id = :id";
        $stmt = $this->connection->prepare($query);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        if ($avatar) {
            $stmt->bindParam(':avatar', $avatar);
        }
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute() ? ['success' => true, 'message' => 'User updated successfully'] : ['success' => false, 'message' => 'User update failed'];
    }
} 
?>

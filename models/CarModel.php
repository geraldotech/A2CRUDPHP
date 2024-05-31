<?php
class CarModel {
    private $pdo;

    // Constructor to set the database connection object
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertCar($marca, $modelo, $cor, $ano, $valor, $status) {
        // Use the database connection object $this->pdo
        $sql = "INSERT INTO cars (marca, modelo, cor, ano, valor, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$marca, $modelo, $cor, $ano, $valor, $status]);
    }
    // public function getAllCars() {
    //     $sql = "SELECT * FROM cars";
    //     $stmt = $this->pdo->query($sql);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function getAllCars() {
        $sql = "SELECT * FROM cars ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editCar($id, $marca, $modelo, $cor, $ano, $valor, $status) {
        $sql = "UPDATE cars SET marca=?, modelo=?, cor=?, ano=?, valor=?, status=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$marca, $modelo, $cor, $ano, $valor, $status, $id]);
    }

    public function getSingle($id) {
        // Prepare the SQL query
        $query = "SELECT * FROM cars WHERE id = :id";
    
        // Prepare the statement
        $statement = $this->pdo->prepare($query);
    
        // Bind the parameter
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
    
        // Execute the query
        $statement->execute();
    
        // Fetch the car details
        $car = $statement->fetch(PDO::FETCH_ASSOC);
    
        // Return the car details
        return $car;
    }

    public function deleteCar($id) {
        // Prepare the SQL query
        $query = "DELETE FROM cars WHERE id = :id";
        
        // Prepare the statement
        $statement = $this->pdo->prepare($query);
        
        // Bind the parameter
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the query
        return $statement->execute();
    }

    public function filterCars($filters) {
        // Base query
        $query = "SELECT * FROM cars WHERE 1=1";

        // Array to hold the query parameters
        $params = [];

        // Add filters to the query
        if (!empty($filters['marca'])) {
            $query .= " AND marca = :marca";
            $params[':marca'] = $filters['marca'];
        }
        if (!empty($filters['modelo'])) {
            $query .= " AND modelo = :modelo";
            $params[':modelo'] = $filters['modelo'];
        }
        if (!empty($filters['cor'])) {
            $query .= " AND cor = :cor";
            $params[':cor'] = $filters['cor'];
        }
        if (!empty($filters['ano'])) {
            $query .= " AND ano = :ano";
            $params[':ano'] = $filters['ano'];
        }
        if (!empty($filters['status'])) {
            $query .= " AND status = :status";
            $params[':status'] = $filters['status'];
        }

        // Prepare the statement
        $statement = $this->pdo->prepare($query);

        // Bind the parameters
        foreach ($params as $key => $value) {
            $statement->bindValue($key, $value);
        }

        // Execute the query
        $statement->execute();

        // Fetch and return the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }    


    public function sumCarValues() {
        try {
            // Prepare the SQL statement to sum values in the cars.valor column
            $sql = "SELECT SUM(valor) AS total_value FROM cars";
            $stmt = $this->pdo->prepare($sql);
            
            // Execute the query
            $stmt->execute();
            
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Return the sum of values
            return $result['total_value'];
        } catch(PDOException $e) {
            // Handle database errors
            return false;
        }
    }


}

?>

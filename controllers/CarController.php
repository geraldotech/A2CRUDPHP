<?php

require_once('../models/CarModel.php');
// Include database configuration
require_once('../config/database.php');

// Check if an action is sent via POST
if(isset($_POST['action'])) {
    // Instantiate CarController object and pass the PDO connection
    $carController = new CarController($conn);
    
    // Determine the action and call the appropriate method
    switch ($_POST['action']) {
        case 'ajaxRegister':
            $carController->ajaxRegister();
            break;
        case 'ajaxUpdate':
            $carController->ajaxUpdate();
            break;
        case 'ajaxGetCarDetails':
            $carController->ajaxGetCarDetails();
            break;
        case 'ajaxDelete': // Add this case for the ajaxDelete action
            $carController->ajaxDelete();
            break;
        default:
            echo json_encode(array("error" => "Invalid action"));
            break;
    }
}


class CarController {
    private $pdo;

    // Constructor to receive the PDO object
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajaxRegister() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the form data
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $cor = $_POST['cor'];
            $ano = $_POST['ano'];
            $valor = $_POST['valor'];
            $status = $_POST['status'];

            // Validate form data if needed

            // Instantiate CarModel object with the database connection object
            $carModel = new CarModel($this->pdo);

            // Call the model method to insert the new car data into the database
            $result = $carModel->insertCar($marca, $modelo, $cor, $ano, $valor, $status);
            
            // Return JSON response indicating success or failure
            if ($result) {
                echo json_encode(array("success" => true));
            } else {
                echo json_encode(array("success" => false, "message" => "Error registering car"));
            }
        }
    }

    public function ajaxUpdate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

             // Debugging: Log received data
      //  file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

        $id = $_POST['edit_car_id'];
        $marca = $_POST['edit_marca'];
        $modelo = $_POST['edit_modelo'];
        $cor = $_POST['edit_cor'];
        $ano = $_POST['edit_ano'];
        $valor = $_POST['edit_valor'];
        $status = $_POST['edit_status'];

            // Validate form data if needed

            // Instantiate CarModel object with the database connection object
            $carModel = new CarModel($this->pdo);

            // Call the model method to update the car data in the database
            $result = $carModel->editCar($id, $marca, $modelo, $cor, $ano, $valor, $status);
            
            // Return JSON response indicating success or failure
            if ($result) {
                echo json_encode(array("success" => true));
            } else {
                echo json_encode(array("success" => false, "message" => "Error updating car"));
            }
        }
    }

    public function getAllCars() {
        // Instantiate CarModel object with the database connection object
        $carModel = new CarModel($this->pdo);

        // Call the model method to fetch all cars from the database
        return $carModel->getAllCars();
    }

    public function ajaxGetCarDetails() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the car ID from the POST data
            $id = $_POST['id'];
    
            // Sanitize and validate the input
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id === false) {
                echo json_encode(array("error" => "Invalid input"));
                return;
            }
    
            // Instantiate CarModel object with the database connection object
            $carModel = new CarModel($this->pdo);
    
            // Call the model method to get the details of the single car
            $car = $carModel->getSingle($id);
    
            // Log the structure of $car for debugging
            error_log("Car details: " . print_r($car, true));
    
            // Return JSON response with car details
            if ($car) {
                // Set HTTP header
                header('Content-Type: application/json');
                echo json_encode($car);
            } else {
                echo json_encode(array("error" => "Car not found"));
            }
        }
    }  

    public function ajaxDelete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve o do carro ID from POST data
            $id = $_POST['id'];
    
            // Sanitize and validate the input
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id === false) {
                echo json_encode(array("error" => "Invalid input"));
                return;
            }
    
            // Instantiate CarModel object with the database connection object
            $carModel = new CarModel($this->pdo);
    
            // Call the model method to delete the car from the database
            $result = $carModel->deleteCar($id);
    
            // retorna JSON response success or failure
            if ($result) {
                echo json_encode(array("success" => true));
            } else {
                echo json_encode(array("success" => false, "message" => "Error deleting car"));
            }
        }
    }

    public function somarValores(){
        $carModel = new CarModel($this->pdo);

       return $carModel->sumCarValues();
      
    }
    
    
}

?>

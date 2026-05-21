<?php

include_once __DIR__ . "/../models/Patient.php";
include_once __DIR__ . "/../config/database.php";

class PatientController {

    private $patient;

    public function __construct() {

        global $conn;

        $this->patient = new Patient($conn);
    }

    public function getPatients() {

        $data = $this->patient->getAllPatients();

        echo json_encode([
            "status" => true,
            "data" => $data
        ], JSON_PRETTY_PRINT);
    }
    public function getPatient($id) {

    $data = $this->patient->getPatientById($id);

    echo json_encode([
        "status" => true,
        "data" => $data
    ], JSON_PRETTY_PRINT);
}
    public function addPatient() {

    $data = json_decode(file_get_contents("php://input"), true);

    $result = $this->patient->createPatient($data);

    if ($result) {

        echo json_encode([
            "status" => true,
            "message" => "Patient Added Successfully"
        ]);

    } else {

        echo json_encode([
            "status" => false,
            "message" => "Failed to Add Patient"
        ]);
    }
}
public function updatePatient($id) {

    $data = json_decode(file_get_contents("php://input"), true);

    $result = $this->patient->updatePatient($id, $data);

    if ($result) {

        echo json_encode([
            "status" => true,
            "message" => "Patient Updated Successfully"
        ]);

    } else {

        echo json_encode([
            "status" => false,
            "message" => "Failed to Update Patient"
        ]);
    }
}
public function deletePatient($id) {

    $result = $this->patient->deletePatient($id);

    if ($result) {

        echo json_encode([
            "status" => true,
            "message" => "Patient Deleted Successfully"
        ]);

    } else {

        echo json_encode([
            "status" => false,
            "message" => "Failed to Delete Patient"
        ]);
    }
}
}

?>
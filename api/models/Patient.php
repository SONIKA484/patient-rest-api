<?php

include_once __DIR__ . "/../config/database.php";

class Patient {

    private $conn;
    private $table = "patients";

    public function __construct($db) {

        $this->conn = $db;
    }

    public function getAllPatients() {

        $sql = "SELECT id, name, age, gender, phone 
                FROM " . $this->table;

        $result = $this->conn->query($sql);

        $patients = [];

        while($row = $result->fetch_assoc()) {

            $patients[] = $row;
        }

        return $patients;
    }
    public function getPatientById($id) {

    $sql = "SELECT id, name, age, gender, phone
            FROM patients
            WHERE id='$id'";

    $result = $this->conn->query($sql);

    return $result->fetch_assoc();
}

    public function createPatient($data) {

        $name = $data['name'];
        $age = $data['age'];
        $gender = $data['gender'];
        $phone = $data['phone'];

        $sql = "INSERT INTO patients (name, age, gender, phone)
                VALUES ('$name', '$age', '$gender', '$phone')";

        if ($this->conn->query($sql)) {

            return true;
        }

        return false;
    }

    public function updatePatient($id, $data) {

        $name = $data['name'];
        $age = $data['age'];
        $gender = $data['gender'];
        $phone = $data['phone'];

        $sql = "UPDATE patients
                SET name='$name',
                    age='$age',
                    gender='$gender',
                    phone='$phone'
                WHERE id='$id'";

        if ($this->conn->query($sql)) {

            return true;
        }

        return false;
    }
    public function deletePatient($id) {

    $sql = "DELETE FROM patients WHERE id='$id'";

    if ($this->conn->query($sql)) {

        return true;
    }

    return false;
}
}

?>
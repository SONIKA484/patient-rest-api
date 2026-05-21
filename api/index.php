<?php

include "middlewares/JsonMiddleware.php";
include "controllers/PatientController.php";

$request = $_GET['request'] ?? '';

$controller = new PatientController();

if ($request == "patients") {

    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        $controller->getPatients();

    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

        $controller->addPatient();
    }

} elseif (preg_match("/patients\/(\d+)/", $request, $matches)) {

    $id = $matches[1];

    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        $controller->getPatient($id);

    } elseif ($_SERVER['REQUEST_METHOD'] == "PUT") {

        $controller->updatePatient($id);

    } elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {

        $controller->deletePatient($id);
    }
}
else {

    echo json_encode([
        "status" => false,
        "message" => "Route Not Found"
    ]);
}

?>
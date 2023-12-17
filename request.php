<?php

require_once 'autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

    if ($contentType === "application/json") {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data["request_key"])) {
            $request_key = $data["request_key"];

            if ($runner = RequestContainer::resolve($request_key)) {
                $result = $runner->run(payload: $data["payload"]);
                if ($result["status"] == "success") {
                    echo json_encode($result["data"]);
                } else {
                    echo json_encode(["error" => "Terjadi Kesalahan Pada Server"]);
                }
            } else {
                echo json_encode(["error" => "Not Provide Request Key " . $request_key]);
            }
        }
    } elseif (strpos($contentType, "multipart/form-data") !== false) {
        if (isset($_POST["request_key"])) {
            $request_key = $_POST["request_key"];

            if ($runner = RequestContainer::resolve($request_key)) {
                $result = $runner->run($_POST["payload"]);

                if ($result["status"] == "success") {
                    echo json_encode($result["data"]);
                }
            }
        } else {
            echo json_encode(["error" => "Request Key Needed"]);
        }
    } else {
        echo json_encode(["error" => "Only Provide JSON and Form Data Type"]);
    }
}

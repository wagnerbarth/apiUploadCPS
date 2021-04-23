<?php

include "config/config.php";
include "database/connect.php";

//this will show error if any error happens
error_reporting(E_ALL);
ini_set('display_errors', 1);

//enable cors
header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Credentials: true');
//header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//header("Access-Control-Allow-Headers: Content-Type");

//check post request
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //get the file
    $ori_fname = $_FILES['file']['name'];

    //get file extension
    $ext = pathinfo($ori_fname, PATHINFO_EXTENSION);

    //target folder
    $target_path = $path; // form config.php

    //replace special chars in the file name
    $actual_fname = $_FILES['file']['name'];
    $actual_fname = preg_replace('/[^A-Za-z0-9\-]/', '', $actual_fname);

    //set random unique name why because file name duplicate will replace
    //the existing files
    $modified_fname = $actual_fname . '-' . uniqid(rand(10, 200)) . '-' . rand(1000, 1000000);

    //set target file path
    $target_path = $target_path . basename($modified_fname) . "." . $ext;

    $result = array();

    $saveDBFile = basename($modified_fname) . "." . $ext;
    $query = "INSERT INTO imagens (imagem, caminho) VALUES ('$ori_fname', 'assets/images/produtos/$saveDBFile')";

    if ($conn->query($query)) {
        //move the file to target folder
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {

            $result["status"] = 1;
            $result["message"] = "Uploaded file successfully.";
        } else {

            $result["status"] = 0;
            $result["message"] = "File upload failed. Please try again.";
        }
    } else {

        $result["status"] = 0;
        $result["message"] = "File save failed. Please try again.";
    }

 echo json_encode($result);
}// end of post request 
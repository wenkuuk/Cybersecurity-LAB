<?php

// Including Duo Auth API
include './DuoAuth/Auth.php';

// Duo API Secrets
$secrets = parse_ini_file("secrets.ini");

$ikey = $secrets["ikey"];
$skey = $secrets["skey"];
$host = $secrets["host"];

// Create client object
$C = new Client($ikey, $skey, $host);

duoAuthentication($C);

// Main function for DUO authentication
function duoAuthentication($C) {
    if (isset($_POST['uname']) && isset($_POST['password'])) {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        $uname = validate($_POST['uname']);
        $pass = validate($_POST['password']);
    
        if (empty($uname)) {
            header("Location: index.php?error=UsernameIsRequired");
            exit();
        } else if (empty($pass)) {
            header("Location: index.php?error=PasswordIsRequired");
            exit();
        } else {
            $preauth_result = $C->jsonApiCall("POST", "/auth/v2/preauth", array("username"=>$uname));
            $result = $preauth_result["response"]["response"]["result"];
            
            if (strncmp($result, "enroll", 6) == 0) {
                ////Enrollment
                enrollUser($C, $uname);
            } else if (strncmp($result, "allow", 5) == 0) {
                //Allowed
                echo "Device is trusted.";
            } else {
                // Authentication
               authUser($C, $uname);
            }
        }
    } else {
        header("Location: index.php");
        exit();
    }
}

// Function to enroll new user
function enrollUser($C, $uname) {
    $json_resp = $C->jsonApiCall("POST", "/auth/v2/enroll", array("username"=>$uname));
    $activation_barcode = $json_resp["response"]["response"]["activation_barcode"];
    header("Location: $activation_barcode");
    exit();
}

// Function to authenticate existing user
function authUser($C, $uname) {
    $auth_resp = $C->jsonApiCall("POST", "/auth/v2/auth", array("username"=>$uname, "device"=>"auto", "factor"=>"push", "async"=>1));
    $txid = $auth_resp["response"]["response"]["txid"];
    
    while (true) {
        $auth_status_resp = $C->jsonApiCall("GET", "/auth/v2/auth_status", array("txid"=>$txid));
        $result = $auth_status_resp["response"]["response"]["result"];
        if (strncmp($result, "allow", 5) == 0) {
            header("Location: success.php");
            exit();
        } else if (strncmp($result, "deny", 4) == 0) {
            header("Location: index.php");
            exit();
        } else {
            echo "Waiting...";
        }
    }
}
?>
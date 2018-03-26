<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-12
 * Time: 12:30 PM
 */

require "PasswordScripts.php";

$password1 = $_GET['password1'];
$password2 = $_GET['password2'];
$username = $_GET['userName'];
$address = $_GET['address'];
$dob = $_GET['dob'];
$name = $_GET['name'];

$conn = oci_connect("ora_q5c1b", "a51931153", "dbhost.ugrad.cs.ubc.ca:1522/ug");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    if($password1 == $password2){
        $usernameCheckQuery = "select username from userTab where username='".$username."'";
        $userCheckOci = oci_parse($conn, $usernameCheckQuery);
        oci_execute($userCheckOci);
        oci_free_statement($userCheckOci);
        $row = oci_fetch_array($userCheckOci, OCI_ASSOC+OCI_RETURN_NULLS);
        if($row != null){
            echo count($row);
            //header('Location: ../Interfaces/CustomerSignUp.html');
            echo "Username already taken\n";
            echo $row[0];
        }
        else{
            $registerQueryUserTab = "insert into UserTab(username, password) VALUES ('".$username."', '".$password1."')";
            $registerQueryCust = "insert into Customer(name, address, dob, username) values ('".$name."', '".$address."', :dob, '".$username."')";
            $nullInd = 0;
            $cust_no = 0;
            while($nullInd != 1) {
                $cust_no = rand(1, 999999);

                $custNoCheckQuery = "select customer_number from RegCustomer where customer_number= :custNo";
                $checkNoOci = oci_parse($conn, $custNoCheckQuery);
                oci_bind_by_name($checkNoOci, ":custNo", $cust_no);
                oci_execute($checkNoOci);
                oci_free_statement($checkNoOci);

                $row = oci_fetch_array($checkNoOci, OCI_ASSOC+OCI_RETURN_NULLS);
                if(count($row) > 0){
                    $nullInd = 1;
                }
            }
            $registerQueryRegCust = "insert into RegCustomer(customer_number, username) values (:custNo, '".$username."')";

            $UserTabOci = oci_parse($conn, $registerQueryUserTab);
            oci_execute($UserTabOci, OCI_COMMIT_ON_SUCCESS);
            oci_free_statement($UserTabOci);

            $CustOci = oci_parse($conn, $registerQueryCust);
            oci_bind_by_name($CustOci, ":dob", strtoupper(date('d-M-y', strtotime($dob))));
            echo strtoupper(date('d-M-y', strtotime($dob)));
            oci_execute($CustOci, OCI_COMMIT_ON_SUCCESS);
            oci_free_statement($CustOci);

            $regCustOci = oci_parse($conn, $registerQueryRegCust);
            oci_bind_by_name($regCustOci, ":custNo", $cust_no);
            oci_execute($regCustOci, OCI_COMMIT_ON_SUCCESS);
            oci_free_statement($regCustOci);

            echo "registered!!!! Fuck yeah!";
            echo $dob;

            oci_close($conn);
        }
    }
    else{
        echo "\nPasswords entered do not match!\n";
        //header('Location: ../Interfaces/CustomerSignUp.html');
    }
}
?>

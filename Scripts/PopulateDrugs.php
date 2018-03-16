<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-16
 * Time: 2:52 PM
 */

$oci_Connector = OCILogon("ora_o9j0b", "a33834152", "ug");

$lines = file("../Data/shortDrugs.csv");

foreach($lines as $data)
{
    list($drugName[], $drugPrescStat[], $price[], $manufNo[], $maxDosage[], $disease[])
        = explode(',', $data);
}

printf("sd");
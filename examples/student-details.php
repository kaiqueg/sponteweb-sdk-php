<?php

include "config.php";

function show(\Sponteweb\API\Entities\Student $student) {
    try {
        $student->fetch($student->getId());
        $active = $student->isActive() ? "S" : "N";
        echo "<p>
        <b>Student_id</b>: {$student->getId()}
        <br/><b>Name</b>: {$student->getName()}
        <br/><b>E-mail</b>: {$student->getEmail()}
        <br/><b>Birthdate</b>: {$student->getBirthdate()}
        <br/><b>Age</b>: {$student->getAge()}
        <br/><b>Active</b>: {$active}
        <br/><b>SponteNetUsername</b>: {$student->getSponteNetUsername()}
        <br/><b>SponteNetPassword</b>: {$student->getSponteNetPassword()}";
        if($student->getGender()) {
            echo "<br/><b>Gender</b>: {$student->getGender()}
        <br/><b>CPF</b>: {$student->getCpf()}
        <br/><b>RG</b>: {$student->getRg()}
        <br/><b>Home Phone</b>: {$student->getHomePhone()}
        <br/><b>Cell Phone</b>: {$student->getCellPhone()}
        <br/><b>Job</b>: {$student->getJob()}
        <br/><b>ZipCode</b>: {$student->getZipCode()}
        <br/><b>City</b>: {$student->getCity()}-{$student->getState()}
        <br/><b>District</b>: {$student->getDistrict()}
        <br/><b>Address</b>: {$student->getAddress()}
        <br/><b>Number</b>: {$student->getNumber()}";
        }
        echo "</p><hr/>";
    } catch (Exception $e) {
        echo "<br/>Can't load details<hr/>";
    }
}

// SEARCH
echo "<h1>SEARCH</h1>";
$list = (new \Sponteweb\API\Entities\Student())->search();
$count = count($list);
echo "<p>Found <b>$count</b> students</p>";

foreach($list as $student) {
    show($student);
}
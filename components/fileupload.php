<?php
function wochenkarte_upload($wochenkarte)
{

    $result = new stdClass(); //this object will carry status from file upload
    $result->fileName = 'document.pdf';
    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $wochenkarte
    $fileName = $wochenkarte["name"];
    $fileType = $wochenkarte["type"];
    $fileTmpName = $wochenkarte["tmp_name"];
    $fileError = $wochenkarte["error"];
    $fileSize = $wochenkarte["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["pdf"];
    if ($fileError == 4) {
        $result->ErrorMessage = "No wochenkarte was chosen. It can always be updated later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = "wochenkarte" . "." . $fileExtension; // 1233343434.jpg i.e
                    $destination = "../uploads/pdf/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                        
                    } else {
                        $result->ErrorMessage = "<br>There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "<br>This speisekarte is bigger than the allowed 2MB. <br> Please choose a smaller one and Update your profile.";
                    return $result;
                }
            } else {
                $result->ErrorMessage = "There was an error uploading - $fileError code. Check php documentation.";
                return $result;
            }
        } else {
            $result->ErrorMessage = "This file type cant be uploaded.";
            return $result;
        }
    }
}
function speise_upload($speisekarte)
{
    $result = new stdClass(); //this object will carry status from file upload
    $result->fileName = 'document.pdf';
    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $wochenkarte
    $fileName = $speisekarte["name"];
    $fileType = $speisekarte["type"];
    $fileTmpName = $speisekarte["tmp_name"];
    $fileError = $speisekarte["error"];
    $fileSize = $speisekarte["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["pdf"];
    if ($fileError == 4) {
        $result->ErrorMessage = "No Speisekarte was chosen. It can always be updated later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = "speisekarte" . "." . $fileExtension; // 1233343434.jpg i.e
                    $destination = "../uploads/pdf/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                        
                    } else {
                        $result->ErrorMessage = "<br>There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "<br>This speisekarte is bigger than the allowed 2MB. <br> Please choose a smaller one and Update your profile.";
                    return $result;
                }
            } else {
                $result->ErrorMessage = "There was an error uploading - $fileError code. Check php documentation.";
                return $result;
            }
        } else {
            $result->ErrorMessage = "This file type cant be uploaded.";
            return $result;
        }
    }
}

function picture_upload($picture)
{
    $result = new stdClass(); //this object will carry status from file upload
    $result->fileName = 'standardevent.jpg';
    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $wochenkarte
    $fileName = $picture["name"];
    $fileType = $picture["type"];
    $fileTmpName = $picture["tmp_name"];
    $fileError = $picture["error"];
    $fileSize = $picture["size"];
    $nameevent = $_POST["name_event"];

    $test1 ="test";
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["jpg","jpeg","png"];
    if ($fileError == 4) {
        $result->ErrorMessage = "No Picture was chosen. It can always be updated later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = "event" ."-".$nameevent. "." . $fileExtension; // 1233343434.jpg i.e
                    $destination = "../uploads/events/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                        
                    } else {
                        $result->ErrorMessage = "<br>There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "<br>This wochenkarte is bigger than the allowed 2MB. <br> Please choose a smaller one and Update your profile.";
                    return $result;
                }
            } else {
                $result->ErrorMessage = "There was an error uploading - $fileError code. Check php documentation.";
                return $result;
            }
        } else {
            $result->ErrorMessage = "This file type cant be uploaded.";
            return $result;
        }
    }
}
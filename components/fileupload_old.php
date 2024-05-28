<?php
function file_upload_speisekarte($document)
{
    require "database/db_connect_Beisl.php";

    $result = new stdClass(); //this object will carry status from file upload
    $result->fileName = 'document.pdf';
    // $down_to = $_POST["name_document"];
    // $file = $_POST["filename"];
    // $oldfilename_id = $_POST['name_document'];
    // $album = $_POST["album"];

    // $sql_searchname = "select * from kunden_auftraege where id = $down_to";
    // $resSE = mysqli_query($connect,$sql_searchname);
    // $rowSE = mysqli_fetch_assoc($resSE);
    // $fname = $rowSE['auftragsnr'];
    // $fk_knr = $rowSE['fk_kundennr'];

    // var_dump($file);
    // die();
    // $sql_name = "select * from fotoalben where id = $album";
    // $res_name = mysqli_query($connect, $sql_name);
    // $rowNM = mysqli_fetch_assoc($res_name);
    // $album_name = $rowNM['name'];

    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $picture
    $fileName = $document["name"];
    $fileType = $document["type"];
    $fileTmpName = $document["tmp_name"];
    $fileError = $document["error"];

    // var_dump($fileName);
    // die();

    $fileSize = $document["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["pdf"];

    if ($fileError == 4) {
        $result->ErrorMessage = "No document was chosen. It can always be updated later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = 'speisekarte'.$fileExtension; // 1233343434.jpg i.e

                    // $fileNewName = "event-".uniqid('')."." . $fileExtension; // 1233343434.jpg i.e
                    // var_dump($fileNewName);
                    // die();
                    $destination = "uploads/pdf/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                    } else {
                        $result->ErrorMessage = "<br>There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "<br>This picture is bigger than the allowed 500Kb. <br> Please choose a smaller one and Update your profile.";
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



function file_upload_auftrag($document)
{
    require "database/db_connect.php";

    $result = new stdClass(); //this object will carry status from file upload
    $result->fileName = 'auftrag.pdf';
    $down_to = $_POST["name_document"];
    // $file = $_POST["filename"];
    // $oldfilename_id = $_POST['name_document'];
    // $album = $_POST["album"];

    $sql_searchname = "select * from kunden_auftraege where id = $down_to";
    $resSE = mysqli_query($connect,$sql_searchname);
    $rowSE = mysqli_fetch_assoc($resSE);
    $fname = $rowSE['auftragsnr'];
    $fk_knr = $rowSE['fk_kundennr'];

    // var_dump($file);
    // die();
    // $sql_name = "select * from fotoalben where id = $album";
    // $res_name = mysqli_query($connect, $sql_name);
    // $rowNM = mysqli_fetch_assoc($res_name);
    // $album_name = $rowNM['name'];

    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $picture
    $fileName = $document["name"];
    $fileType = $document["type"];
    $fileTmpName = $document["tmp_name"];
    $fileError = $document["error"];

    // var_dump($fileName);
    // die();

    $fileSize = $document["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["pdf", "docx", "txt","zip"];
    if ($fileError == 4) {
        $result->ErrorMessage = "No document was chosen. It can always be updated later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = 'Auftrag_'.$fname.".".$fileExtension; // 1233343434.jpg i.e

                    // $fileNewName = "event-".uniqid('')."." . $fileExtension; // 1233343434.jpg i.e
                    // var_dump($fileNewName);
                    // die();
                    $destination = "uploads/documents/auftraege/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                    } else {
                        $result->ErrorMessage = "<br>There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "<br>This picture is bigger than the allowed 500Kb. <br> Please choose a smaller one and Update your profile.";
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

function file_upload_rechnung($document)
{
    require "database/db_connect.php";

    $result = new stdClass(); //this object will carry status from file upload
    $result->fileName = 'rechnung.pdf';
    $down_to = $_POST["name_document"];
    // $file = $_POST["filename"];
    // $oldfilename_id = $_POST['name_document'];
    // $album = $_POST["album"];

    $sql_searchname = "select * from rechnungen where id = $down_to";
    $resSE = mysqli_query($connect,$sql_searchname);
    $rowSE = mysqli_fetch_assoc($resSE);
    $fname = $rowSE['billnumber'];
    $fk_knr = $rowSE['fk_kdr'];

    // var_dump($fname);
    // die();
    // $sql_name = "select * from fotoalben where id = $album";
    // $res_name = mysqli_query($connect, $sql_name);
    // $rowNM = mysqli_fetch_assoc($res_name);
    // $album_name = $rowNM['name'];

    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $picture
    $fileName = $document["name"];
    $fileType = $document["type"];
    $fileTmpName = $document["tmp_name"];
    $fileError = $document["error"];

    // var_dump($fileName);
    // die();

    $fileSize = $document["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["pdf", "docx", "txt","zip"];
    if ($fileError == 4) {
        $result->ErrorMessage = "No document was chosen. It can always be updated later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = 'Rechnung_'.$fname.".".$fileExtension; // 1233343434.jpg i.e

                    // $fileNewName = "event-".uniqid('')."." . $fileExtension; // 1233343434.jpg i.e
                    // var_dump($fileNewName);
                    // die();
                    $destination = "uploads/documents/rechnungen/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                    } else {
                        $result->ErrorMessage = "<br>There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "<br>This picture is bigger than the allowed 500Kb. <br> Please choose a smaller one and Update your profile.";
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

function file_upload_project($document)
{
    require "database/db_connect.php";

    $result = new stdClass(); //this object will carry status from file upload
    $result->fileName = 'project.zip';
    $down_to = $_POST["name_document"];
    // $file = $_POST["filename"];
    // $oldfilename_id = $_POST['name_document'];
    // $album = $_POST["album"];

    $sql_searchname = "select * from kunden_auftraege where id = $down_to";
    $resSE = mysqli_query($connect,$sql_searchname);
    $rowSE = mysqli_fetch_assoc($resSE);
    $fname = $rowSE['auftragsnr'];
    $fk_knr = $rowSE['fk_kdr'];
    // var_dump($fname);
    // die();
    // $sql_name = "select * from fotoalben where id = $album";
    // $res_name = mysqli_query($connect, $sql_name);
    // $rowNM = mysqli_fetch_assoc($res_name);
    // $album_name = $rowNM['name'];

    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $picture
    $fileName = $document["name"];
    $fileType = $document["type"];
    $fileTmpName = $document["tmp_name"];
    $fileError = $document["error"];
    $re_date = date("dmY"); //CReate Date


    // var_dump($fileName);
    // die();

    $fileSize = $document["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["zip"];
    $fileid = $fileid+1;
    if ($fileError == 4) {
        $result->ErrorMessage = "No document was chosen. It can always be updated later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 120000000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = 'Projektfiles_'.$re_date.'-'.uniqid('').'-'.$fname.".".$fileExtension; // 1233343434.jpg i.e

                    // $fileNewName = "event-".uniqid('')."." . $fileExtension; // 1233343434.jpg i.e
                    // var_dump($fileNewName);
                    // die();
                    $destination = "uploads/documents/projektfiles/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                    } else {
                        $result->ErrorMessage = "<br>There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "<br>This picture is bigger than the allowed 500Kb. <br> Please choose a smaller one and Update your profile.";
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
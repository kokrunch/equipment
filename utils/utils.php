<?php

class Utils
{


    public function uploadImage($filename, $fileSize, $directory)
    {
        try {
            // file name
            if ($fileSize > 4000000) {
                $response = ["File exceeds maximum size (4MB)"];
                return $response;
            }

            $temp = explode(".", $filename);
            $newfilename = round(microtime(true)) . '.' . end($temp);

            // Location
            $location = '../assets/' . $directory . '/' . $newfilename;
            // file extension
            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            // Valid extensions
            $valid_ext = array("jpg", "png", "jpeg");


            if (in_array($file_extension, $valid_ext)) {
                // Upload file
                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                    $response = ['upload success', $newfilename];
                    return $response;
                }
            } else {
                $response = ["Invalid file type"];
                return $response;
            }
        } catch (Exception $e) {
            //throw $th;
            echo $e;
        }
    }


    //อัปหลายไฟล์
    public function uploadImageMultiple($filename, $fileSize, $directory, $i)
    {
        try {
            // file name
            if ($fileSize > 4000000) {
                $response = ["File exceeds maximum size (4MB)"];
                return $response;
            }

            $temp = explode(".", $filename);
            $newfilename = rand(rand(), rand());
            $newfilename = $newfilename . date("ydmY");
            $newfilename = $newfilename . '.' . end($temp);

            // Location
            $location = '../assets/' . $directory . '/' . $newfilename;
            // file extension
            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            // Valid extensions
            $valid_ext = array("jpg", "png", "jpeg");


            if (in_array($file_extension, $valid_ext)) {
                // Upload file
                if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
                    $response = ['upload success', $newfilename];
                    return $response;
                }
            } else {
                $response = ["Invalid file type"];
                return $response;
            }
        } catch (Exception $e) {
            //throw $th;
            echo $e;
        }
    }
}

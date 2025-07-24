<?php
// ini_set("display_errors",1);
date_default_timezone_set('Asia/Kolkata');
$db = new mysqli('localhost','jt_laravel','88?55ilhneeJXsPvt','jt_laravel');
if($db->connect_errno){
    die('Sorry, We are having some errors');
}

// Establish a database connection
$conn = new mysqli('localhost','jt_laravel','88?55ilhneeJXsPvt','jt_laravel');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the SELECT query
$sql = "SELECT * FROM products WHERE `image_link` != '' AND (`photos` IS NULL OR `photos` = '') AND `published` = 1 ORDER BY `id` ASC LIMIT 5 ";

// Execute the query
$result = $conn->query($sql);

// Check if the query executed successfully
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            $image_link = $row['image_link'];
            $id = $row['id'];


            $url = explode(",",$image_link);
            $len = sizeof($url);

            for($i=0;$i<$len;$i++)
            {
                // URL of the image to download
                $imageUrl = $url[$i];


                // Folder where you want to save the image
                $destinationFolder = '../public/uploads/all/';

                // Get the filename from the URL
                $filename = basename($imageUrl);
                echo $filename.'<br/>';


                // Check if the destination folder exists, if not create it
                if (!file_exists($destinationFolder)) {
                    mkdir($destinationFolder, 0755, true);
                }

                // Path where the image will be saved
                $destinationPath = $destinationFolder . $filename;

                

                // Download the image
                $imageContent = file_get_contents($imageUrl);

                // Check if the image was downloaded successfully
                if ($imageContent !== false) {
                    // Save the image to the destination folder
                    if (file_put_contents($destinationPath, $imageContent) !== false) {

                        // Get the filename without extension
                        $file_original_name = pathinfo($filename, PATHINFO_FILENAME);

                        // Get the extension
                        $extension = pathinfo($filename, PATHINFO_EXTENSION);  
                        
                        $filename = "uploads/all/".$filename;

                        // Get the file size in bytes
                        $fileSizeBytes = filesize($destinationPath);

                        // Convert bytes to kilobytes
                        $fileSize = round($fileSizeBytes, 2);

                        $sql_1 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'jt_laravel' AND TABLE_NAME = 'uploads' ";
                        $query_1 = $db->query($sql_1);
                        $row_1 = $query_1->fetch_assoc();

                        $new_id = $row_1['AUTO_INCREMENT'];

                        // Prepare SQL statement
                        $stmt = $conn->prepare("INSERT INTO uploads (`file_original_name`,`file_name`,`user_id`,`file_size`,`extension`,`type`) VALUES ('$file_original_name','$filename','9','$fileSize','$extension','image')");
                        // Execute the query
                        if ($stmt->execute() === TRUE) {

                            $sql_2 = "SELECT * FROM `products` WHERE `id` = '$id'";
                            $query_2 = $db->query($sql_2);
                            $row_2 = $query_2->fetch_assoc();

                            
                            if($row_2['photos']==null || $row_2['photos'] == '')
                            {
                                $sql_3 = "UPDATE products SET `photos`='$new_id',`thumbnail_img`='$new_id' WHERE `id` = '$id'";
		                        $query_3 = $db->query($sql_3);
                            }
                            else
                            {
                                $new_id = $row_2['photos'].','.$new_id;

                                $sql_3 = "UPDATE products SET `photos`='$new_id' WHERE `id` = '$id'";
		                        $query_3 = $db->query($sql_3);
                            }

                        } else {
                            echo "Error: " . $conn->error;
                        }
                        
                    } else {
                        echo "Error: Unable to save the image.";
                    }
                } else {
                    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

                    $sql_uploads = "SELECT * FROM `uploads` WHERE `file_original_name` LIKE '$filenameWithoutExtension' LIMIT 1";
                    $query_uploads = $db->query($sql_uploads);
                    $row_uploads = $query_uploads->fetch_assoc();

                    if($row_uploads['id'] != ''){

                        $new_id = $row_uploads['id'];
                        
                        $sql_2 = "SELECT * FROM `products` WHERE `id` = '$id'";
                        $query_2 = $db->query($sql_2);
                        $row_2 = $query_2->fetch_assoc();

                        
                        if($row_2['photos']==null || $row_2['photos'] == '')
                        {
                            $sql_3 = "UPDATE products SET `photos`='$new_id',`thumbnail_img`='$new_id' WHERE `id` = '$id'";
                            $query_3 = $db->query($sql_3);
                        }
                        else
                        {
                            $new_id = $row_2['photos'].','.$new_id;

                            $sql_3 = "UPDATE products SET `photos`='$new_id' WHERE `id` = '$id'";
                            $query_3 = $db->query($sql_3);
                        }
                    }else{
                        echo "Error: Unable to download the image : ".$filename.'<br/>';
                    }
                }
            }
        }
    } else {
        echo "No results found";
    }
}

// Close connection
$conn->close();



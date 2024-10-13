<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$mediaDir = 'o/'; // Define the directory where the videos are stored
$videoFiles = [];

$allowedExtensions = ['mp4']; //you may add more extenstion if needed like ['mp4','avi']

if (is_dir($mediaDir)) {
    if ($dh = opendir($mediaDir)) {
        while (($file = readdir($dh)) !== false) {
            $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            // If it's an allowed video file, add it to the list
            if (in_array($fileExtension, $allowedExtensions)) {
                $videoFiles[] = $mediaDir . $file; // Store full path of the video file
            }
        }
        closedir($dh); // Close the directory
    }
}

header('Content-Type: application/json');
echo json_encode($videoFiles);
?>

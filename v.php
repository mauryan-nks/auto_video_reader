<?php
header("Access-Control-Allow-Origin: *");

// Optionally, if you're accepting other methods (like POST, PUT, DELETE), you can add:
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Define the directory where the videos are stored
$mediaDir = 'o/';

// Array to hold video files
$videoFiles = [];

// Allowed file extension for videos
$allowedExtensions = ['mp4'];

// Check if the directory exists
if (is_dir($mediaDir)) {
    // Open the directory
    if ($dh = opendir($mediaDir)) {
        // Read files from the directory
        while (($file = readdir($dh)) !== false) {
            // Get the file extension
            $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            // If it's an allowed video file, add it to the list
            if (in_array($fileExtension, $allowedExtensions)) {
                $videoFiles[] = $mediaDir . $file; // Store full path of the video file
            }
        }
        closedir($dh); // Close the directory
    }
}

// Return the video files as a JSON response
header('Content-Type: application/json');
echo json_encode($videoFiles);
?>

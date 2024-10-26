<?php
// Load the XML file
$xml = simplexml_load_file('images.xml');

// Pagination variables
$images_per_page = 6; // Number of images per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_index = ($page - 1) * $images_per_page;

// Get all images from the XML file
$images = $xml->image;
$total_images = count($images);

// Extract the images for the current page using array_slice-like logic
$display_images = array();
for ($i = $start_index; $i < ($start_index + $images_per_page) && $i < $total_images; $i++) {
    $display_images[] = $images[$i];
}

// Generate HTML for the images
foreach ($display_images as $image) {
    echo '<div class="image-item">';
    echo '<img src="' . $image->url . '" alt="' . $image->title . '">';
    echo '<h2>' . $image->title . '</h2>';
    echo '<p>' . $image->description . '</p>';
    echo '</div>';
}

// Optional: Display message if no images
if (empty($display_images)) {
    echo '<p>No more images to display.</p>';
}
?>

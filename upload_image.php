<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $api_url = "https://api.imageshack.com/v2/images";
    $api_key = "7AGHILQR30cfa7083d5abcc9ce13bed0655b4537";  // Replace with your actual API key
    $image_file = $_FILES['image']['tmp_name'];  // The image from the form input

    $post_fields = array(
        'image' => new CURLFile($image_file),
        'key' => $api_key,
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Handle the response
    $data = json_decode($response, true);
    if (isset($data['links']['image_link'])) {
        echo "Image uploaded successfully. View it here: " . $data['links']['image_link'];
    } else {
        echo "Error uploading image.";
    }
}
?>

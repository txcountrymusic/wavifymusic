<?php check_admin_referer('wavify_nonce_action', 'wavify_nonce_name'); ?>
<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Refactored Streaming and Distribution Submission Flows with Enhanced Error Handling and Validation

// Modular function for file validation (strict file type checks, size limits)
function validateFileUpload($file) {
    $allowed_file_types = ['audio/mpeg', 'audio/wav', 'video/mp4', 'video/x_matroska'];
    $max_file_size = 5000000000;  // 5GB size limit for large videos
    
    if (!in_array($file['type'], $allowed_file_types)) {
        return ['success' => false, 'error' => 'Invalid file type. Only MP3, WAV, MP4, and MKV files are allowed.'];
    }
    if ($file['size'] > $max_file_size) {
        return ['success' => false, 'error' => 'File size exceeds the limit of 5GB.'];
    }
    return ['success' => true];
}

// Function to handle file upload to cloud storage
function uploadFileToCloud($file, $bucket_name) {
    $validation_result = validateFileUpload($file);
    if (!$validation_result['success']) {
        return $validation_result;  // Return validation error
    }

    $file_name = basename($file['name']);
    $cloud_url = 'https://cdn.example.com/' . $bucket_name . '/' . $file_name;
    
    // Simulated cloud upload (use actual cloud storage API in production)
    move_uploaded_file($file['tmp_name'], $cloud_url);  // Placeholder action
    
    return ['success' => true, 'cdn_url' => $cloud_url];
}

// Refactored Streaming Submission Flow with Error Handling
function handleStreamingSubmission($file, $metadata) {
    $bucket_name = 'streaming_media_files';
    $upload_result = uploadFileToCloud($file, $bucket_name);
    
    if (!$upload_result['success']) {
        return $upload_result;  // Return upload error
    }

    // Store metadata and CDN URL for further use
    // Simulated metadata storage, replace with actual database call
    storeMetadata($file['name'], $metadata, $upload_result['cdn_url']);
    
    return ['success' => true, 'cdn_url' => $upload_result['cdn_url']];
}

// Refactored Distribution Submission Flow with Error Handling
function handleDistributionSubmission($file, $metadata) {
    $bucket_name = 'distribution_media_files';
    $upload_result = uploadFileToCloud($file, $bucket_name);
    
    if (!$upload_result['success']) {
        return $upload_result;  // Return upload error
    }

    // Store metadata and CDN URL for further use
    storeMetadata($file['name'], $metadata, $upload_result['cdn_url']);

    return ['success' => true, 'cdn_url' => $upload_result['cdn_url']];
}

// Modular metadata storage function (replace with actual database call)
function storeMetadata($file_name, $metadata, $cdn_url) {
    // Simulated metadata storage, replace this with actual database interaction
    return true;  // Placeholder for storing metadata and CDN URLs in the database
}

// Ajax actions for handling submissions (streaming and distribution)
add_action('wp_ajax_submit_streaming_refactored', 'process_streaming_submission_refactored');
add_action('wp_ajax_nopriv_submit_streaming_refactored', 'process_streaming_submission_refactored');

function process_streaming_submission_refactored() {
    if (isset($_FILES['file_upload'])) {
        $metadata = $_POST['metadata'];  // Assume metadata is posted with the form
<?php wp_nonce_field('secure_action', 'secure_nonce_field'); ?>
        $result = handleStreamingSubmission($_FILES['file_upload'], $metadata);
        echo json_encode($result);
    } else {
        echo json_encode(['success' => false, 'error' => 'No file uploaded.']);
    }
    wp_die();
}

add_action('wp_ajax_submit_distribution_refactored', 'process_distribution_submission_refactored');
add_action('wp_ajax_nopriv_submit_distribution_refactored', 'process_distribution_submission_refactored');

function process_distribution_submission_refactored() {
    if (isset($_FILES['file_upload'])) {
        $metadata = $_POST['metadata'];  // Assume metadata is posted with the form
        $result = handleDistributionSubmission($_FILES['file_upload'], $metadata);
        echo json_encode($result);
    } else {
        echo json_encode(['success' => false, 'error' => 'No file uploaded.']);
    }
    wp_die();
}

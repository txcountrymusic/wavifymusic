<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Core Feature Refactoring: Modularizing Submission Flows, Metadata Handling, Cloud/CDN

// Modular submission handler
function handleSubmission($file, $metadata, $type) {
    $bucket_name = ($type === 'streaming') ? 'streaming_media_files' : 'distribution_media_files';
    
    // Upload file to cloud and get the CDN URL
    $upload_result = uploadFileToCloud($file, $bucket_name);
    
    if (!$upload_result['success']) {
        return $upload_result;  // Return upload error
    }

    // Store metadata and CDN URL
    $metadata_store = storeMetadata($file['name'], $metadata, $upload_result['cdn_url'], $type);
    
    return ['success' => true, 'cdn_url' => $upload_result['cdn_url'], 'metadata_store' => $metadata_store];
}

// Refactor streaming submission
function processStreamingSubmission($file, $metadata) {
    return handleSubmission($file, $metadata, 'streaming');
}

// Refactor distribution submission
function processDistributionSubmission($file, $metadata) {
    return handleSubmission($file, $metadata, 'distribution');
}

// Refactor metadata storage for reuse
function storeMetadata($file_name, $metadata, $cdn_url, $type) {
    global $wpdb;
    
    // Store metadata in the database (refactored)
    $table_name = ($type === 'streaming') ? 'wp_streaming_metadata' : 'wp_distribution_metadata';
    
    $result = $wpdb_>insert(
        $table_name,
        [
            'file_name' => $file_name,
            'metadata' => json_encode($metadata),
            'cdn_url' => $cdn_url,
            'submission_type' => $type,
            'submission_date' => current_time('mysql')
        ]
    );
    
    return $result;
}

// Cloud storage and CDN handler (reusable)
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

// Modular file validation for reuse
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

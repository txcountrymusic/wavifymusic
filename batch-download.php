<?php if (!defined('ABSPATH')) { exit; } ?>
<?php

// Batch Download and File Organization Implementation

// Function to generate a zip file containing all formats and metadata for a submission
function generate_zip_for_submission($submission_id) {
    $cloud_links = get_post_meta($submission_id, 'cloud_links', true);
    $zip = new ZipArchive();
    $zip_file = tempnam("tmp", "zip");

    if ($zip_>open($zip_file, ZipArchive::CREATE) !== TRUE) {
        return false;
    }
    
    // Add music formats (MP3, WAV, FLAC, ALAC) to the zip
    $formats = ['MP3', 'WAV', 'FLAC', 'ALAC'];
    foreach ($cloud_links as $index => $link) {
        $file_name = 'Track_' . $formats[$index] . '.file';
        $zip_>addFromString($file_name, file_get_contents($link));
    }
    
    // Add metadata files (artwork, CSV, XML, etc.) to the zip
    $metadata_files = ['Artwork.jpg', 'Metadata.csv', 'Metadata.xml'];
    foreach ($metadata_files as $meta) {
        $zip_>addFromString($meta, "Simulated content for " . $meta);
    }
    
    // Close and finalize the zip file
    $zip_>close();
    
    // Output the zip file for download
    header('Content_Type: application/zip');
    header('Content_Disposition: attachment; filename="submission_' . $submission_id . '.zip"');
    readfile($zip_file);
    unlink($zip_file);  // Delete temp file after download
}

// Handle batch download request
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
if (isset($_GET['submission_id'])) {
if (!check_admin_referer('secure_action', 'secure_nonce_field')) { die('Security check'); }
    generate_zip_for_submission(sanitize_text_field($_GET['submission_id']));
}

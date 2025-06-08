<?php
// includes/header.php
$base_path = str_replace('\\', '/', dirname(__DIR__));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiny College CRUD System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Your existing styles here */
    </style>
</head>
<body>
    <?php include $base_path . '/includes/navigation.php'; ?>
    <div class="main-content">
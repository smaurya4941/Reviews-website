<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo isset($title) ? htmlspecialchars(ucwords($title)) : 'Bizorm - Review'; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <!-- Bootstrap (keep for consistency with rest of app) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome (stars, icons) -->
    <script src="https://kit.fontawesome.com/ca92620e44.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Google Fonts Inter (rating.css imports it but add preconnect here too) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<body style="margin:0;padding:0;">


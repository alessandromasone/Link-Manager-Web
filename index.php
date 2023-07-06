<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Preferiti</title>
</head>

<body>
    <div id="sidebar" class="sidebar">
        <div class="tree" id="directoryTree">
            <ul class="list-unstyled">
            </ul>
        </div>
    </div>

    <?php include_once('php/modal.php'); ?>

    <script src="js/generate-home.js"></script>

    <script src="js/highlights-element.js"></script>
    <script src="js/folder-click.js"></script>
    <script src="js/drag.js"></script>
    <script src="js/create.js"></script>
    <script src="js/delete.js"></script>
    <!--<script src="js/sidebar.js"></script>-->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
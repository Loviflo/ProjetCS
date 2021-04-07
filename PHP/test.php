<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../utils/head.php'; ?>
    <title>Test</title>
</head>
<body>
    <?php 
        include '../utils/header.php'; 
        $city = !isset($_GET['city']) ?'': $_GET['city'];
        echo $city;
    ?>
    <a href="test.php?city=Montpellier">Montpellier</a>
    <a href="test.php?city=Marseille">Marseille</a>
    <div id="test"></div>
    <script src="../JS/app.js"></script>

</body>
</html>
<?php 
    require '../utils/database.php';
    ini_set('display_errors', 0);
    $db = getDatabaseConnection();
    $date = $_GET['date'];
    $sql = "SELECT *, DATE_FORMAT(date,'%d/%m/%Y %H:%i'), CONCAT(hsp,'%') as hsp, CONCAT(mvp,'⭐') as mvp FROM wingman WHERE date = '$date' ORDER BY id DESC";
    $statement = $db->prepare($sql);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }

    $mvps = 0;
    foreach ($rows as $key => $value) {
        if ($value['playerName'] == 'Loviflo' || $value['playerName'] == 'Ilesis') {
            $mvps += $value['mvp'];
        }
    }
    if ($mvps > 8) {
        $result = 'Victoire';  
    } elseif ($mvps == 8) {
        $result = 'Egalité';
    } else {
        $result = 'Défaite';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../utils/head.php' ?>
    <title>Partie</title>
</head>
<body>
    <?php include '../utils/header.php' ?>
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Ping</th>
                    <th>Kills</th>
                    <th>Assists</th>
                    <th>Deaths</th>
                    <th>MVP</th>
                    <th>HSP</th>
                    <th>ADR</th>
                    <th>UD</th>
                    <th>EF</th>
                    <th>Score du joueur</th>
                    <th>Rang</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $keys => $value) { ?>
                <tr>
                    <td class="test"><?php echo $value['playerName']; ?></td>
                    <td class="test"><?php echo $value['ping']; ?></td>
                    <td class="test"><?php echo $value['kills']; ?></td>
                    <td class="test"><?php echo $value['assists']; ?></td>
                    <td class="test"><?php echo $value['deaths']; ?></td>
                    <td class="test"><?php echo $value['mvp']; ?></td>
                    <td class="test"><?php echo $value['hsp']; ?></td>
                    <td class="test"><?php echo $value['adr']; ?></td>
                    <td class="test"><?php echo $value['ud']; ?></td>
                    <td class="test"><?php echo $value['ef']; ?></td>
                    <td class="test"><?php echo $value['playerScore']; ?></td>
                    <td class="test"><?php echo $value['rank']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-5">
            <div class="col"><?php echo '<h3>' . $value['map'] . '</h3>' ?></div>
            <div class="col"><?php echo '<h3>' . $value['DATE_FORMAT(date,\'%d/%m/%Y %H:%i\')'] . '</h3>' ?></div>
            <div class="col"><?php echo '<h3>' . $value['waitTime'] . '</h3>' ?></div>
            <div class="col"><?php echo '<h3>' . $value['matchDuration'] . '</h3>' ?></div>
            <div class="col"><?php echo '<h3>' . $value['matchScore'] . '</h3>' ?></div>
            <div class="col"><?php echo '<h3>' . $result . '</h3>'; ?></div>
        </div>
    </div>
</body>
</html>

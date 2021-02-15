<?php
    require '../utils/database.php'; 

    ini_set('display_errors', 1);

    $offset = isset($_GET['offset']) && !empty($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) && !empty($_GET['limit']) ? intval($_GET['limit']) : 100;
    $db = getDatabaseConnection();
    $where = [];
    $params = [];
    if(!isset($_GET['matchScore'])){$_GET['matchScore'] = '';}
    if(!empty($_GET['matchScore'])) {
        $where[] = 'matchScore = ?';
        $params[] = $_GET['matchScore'];
    }
    if(!isset($_GET['map'])){$_GET['map'] = '';}
    if(!empty($_GET['map'])) {
        $where[] = 'map LIKE ?';
        $params[] = "%". $_GET['map'] . "%";
    }
    $sql = 'SELECT DISTINCT map, date, waitTime, matchDuration, matchScore FROM wingman';
    if(count($where) > 0) {
        $whereClause = join(" AND ", $where);
        $sql .= " WHERE " . $whereClause;
    }
    $sql .= " ORDER BY date DESC";
    $sql .= " LIMIT $offset, $limit";
    $statement = $db->prepare($sql);
    if($statement !== false){
        $success = $statement->execute($params);
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    $counter = 0; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../utils/head.php'; ?>
    <title>Parties</title>
</head>
<body onload="test();">
<?php include "../utils/header.php"; ?>
    <form method="GET" action="games.php">
        <div class="form-group">
        <label class="form-label">Limit</label>
        <?php echo '<input type="text" class="form-control" name="limit" value="'. $limit .'" id="" placeholder="Limite...">'; ?>
        <label class="form-label">matchScore</label>
        <?php echo '<input type="text" class="form-control" name="matchScore" value="'. $_GET["matchScore"] .'" id="" placeholder="matchScore...">'; ?>
        <label for="">map</label>
        <select class="form-control" name="map">
            <option value="">Choisi une map</option>
            <option <?php echo $_GET['map'] == 'Nuke' ? 'selected' : ''; ?>>Nuke</option>
            <option <?php echo $_GET['map'] == 'Cobblestone' ? 'selected' : ''; ?>>Cobblestone</option>
            <option <?php echo $_GET['map'] == 'Lake' ? 'selected' : ''; ?>>Lake</option>
            <option <?php echo $_GET['map'] == 'Inferno' ? 'selected' : ''; ?>>Inferno</option>
            <option <?php echo $_GET['map'] == 'Train' ? 'selected' : ''; ?>>Train</option>
            <option <?php echo $_GET['map'] == 'Overpass' ? 'selected' : ''; ?>>Overpass</option>
            <option <?php echo $_GET['map'] == 'Rialto' ? 'selected' : ''; ?>>Rialto</option>
            <option <?php echo $_GET['map'] == 'Vertigo' ? 'selected' : ''; ?>>Vertigo</option>
            <option <?php echo $_GET['map'] == 'Elysion' ? 'selected' : ''; ?>>Elysion</option>
            <option <?php echo $_GET['map'] == 'Guard' ? 'selected' : ''; ?>>Guard</option>
            <option <?php echo $_GET['map'] == 'Shortdust' ? 'selected' : ''; ?>>Shortdust</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Afficher</button>
    </form>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Carte</th>
                <th>Date</th>
                <th>Temps d'attente</th>
                <th>Temps du match</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $keys => $value) { ?>
            <tr onmouseover="style.backgroundColor = '#fa2'" onmouseout="style.backgroundColor = '#fff'" onclick="window.location.href='http://viviansrv.ddns.net/PHP/game.php?date=<?php echo $value['date']; ?>'">
                <td class="test"><?php echo $value['map']; ?></td>
                <td class="test"><?php echo $value['date']; ?></td>
                <td class="test"><?php echo $value['waitTime']; ?></td>
                <td class="test"><?php echo $value['matchDuration']; ?></td>
                <td class="test"><?php echo $value['matchScore']; ?></td>
            </tr>
        <?php 
            $counter++; 
            } 
            echo "<h3>Nombre de lignes : " . $counter . "</h3>"
        ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="../JS/script.js"></script>
</body>
</html>
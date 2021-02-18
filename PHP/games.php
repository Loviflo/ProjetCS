<?php
    require '../utils/database.php'; 

    ini_set('display_errors', 1);

    $db = getDatabaseConnection();

    $offset = isset($_GET['offset']) && !empty($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) && !empty($_GET['limit']) ? intval($_GET['limit']) : 100;
    $by = isset($_GET['by']) && !empty($_GET['by']) ? $_GET['by'] : 'id';
    $order = isset($_GET['order']) && !empty($_GET['order']) ? $_GET['order'] : 'DESC';
    $where = [];
    $params = [];
    if(!isset($_GET['matchScore'])){$_GET['matchScore'] = '';}
    if(!empty($_GET['matchScore'])) {
        $where[] = 'matchScore LIKE ?';
        $params[] = "%" . $_GET['matchScore'] . "%";
    }
    if(!isset($_GET['map'])){$_GET['map'] = '';}
    if(!empty($_GET['map'])) {
        $where[] = 'map LIKE ?';
        $params[] = "%" . $_GET['map'] . "%";
    }
    $sql = "SELECT DISTINCT map, date, DATE_FORMAT(date,'%d/%m/%Y %H:%i'), waitTime, matchDuration, matchScore FROM wingman";
    if(count($where) > 0) {
        $whereClause = join(" AND ", $where);
        $sql .= " WHERE " . $whereClause;
    }
    $sql .= " ORDER BY $by $order";
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
        <div class="form-group mt-2 mx-5">
            <div class="form-floating mb-3">
                <input name="limit" type="text" class="form-control" id="floatingInput" value="<?php echo $limit; ?>" placeholder="Limite...">
                <label for="floatingInput">Limite</label>
            </div>
            <div class="form-floating">
                <input name="matchScore" type="text" class="form-control" id="floatingPassword" value="<?php echo $_GET['matchScore']; ?>" placeholder="Score du match...">
                <label for="floatingPassword">Score du match</label>
            </div>
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
        <button type="submit" class="btn btn-primary mt-2 ms-5">Afficher</button>
    </form>
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Carte</th>
                    <th onclick="window.location.href='http://viviansrv.ddns.net/PHP/games.php?by=date&order=ASC'">Date</th>
                    <th onclick="window.location.href='http://viviansrv.ddns.net/PHP/games.php?by=waitTime&order=ASC'">Temps d'attente</th>
                    <th onclick="window.location.href='http://viviansrv.ddns.net/PHP/games.php?by=matchDuration&order=ASC'">Temps du match</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $keys => $value) { ?>
                <tr onclick="window.location.href='http://viviansrv.ddns.net/PHP/game.php?date=<?php echo $value['date']; ?>'">
                    <td class="test"><?php echo $value['map']; ?></td>
                    <td class="test"><?php echo $value['DATE_FORMAT(date,\'%d/%m/%Y %H:%i\')']; ?></td>
                    <td class="test"><?php echo $value['waitTime']; ?></td>
                    <td class="test"><?php echo $value['matchDuration']; ?></td>
                    <td class="test"><?php echo $value['matchScore']; ?></td>
                </tr>
            <?php 
                $counter++; 
                } 
                echo "<h3>Nombre de lignes : " . $counter . "</h3>";
            ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="../JS/script.js"></script>
</body>
</html>
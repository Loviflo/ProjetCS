<?php
    require '../utils/database.php'; 

    ini_set('display_errors', 1);

    $offset = isset($_GET['offset']) && !empty($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) && !empty($_GET['limit']) ? intval($_GET['limit']) : 100;
    $db = getDatabaseConnection();
    $where = [];
    $params = [];
    if(!isset($_GET['Score'])){$_GET['Score'] = '';}
    if(!empty($_GET['Score'])) {
        $where[] = 'Score = ?';
        $params[] = $_GET['Score']; // eq array_push
    }
    if(!isset($_GET['Carte'])){$_GET['Carte'] = '';}
    if(!empty($_GET['Carte'])) {
        $where[] = 'Carte LIKE ?';
        $params[] = "%". $_GET['Carte'] . "%"; // eq array_push
    }
    $sql = 'SELECT ID, Date, RankY, RankV, Score, Carte, Résultat, RankE1, RankE2, Info FROM wingman';
    if(count($where) > 0) {
        $whereClause = join(" AND ", $where);
        $sql .= " WHERE " . $whereClause;
    }
    $sql .= " ORDER BY ID DESC";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>        <script src="chart.js"></script>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="16x16" href="http://viviansrv.ddns.net/Images/logoCSGO.png">
    <title>Games</title>
</head>
<body>
<?php include "../utils/header.php"; ?>
    <form method="GET" action="games.php">
        <div class="form-group">
        <label class="form-label">Limit</label>
        <?php echo '<input type="text" class="form-control" name="limit" value="'. $limit .'" id="" placeholder="Limite...">'; ?>
        <label class="form-label">Score</label>
        <?php echo '<input type="text" class="form-control" name="Score" value="'. $_GET["Score"] .'" id="" placeholder="Score...">'; ?>
        <label for="">Carte</label>
        <select class="form-control" name="Carte">
            <option value="">Choisi une carte</option>
            <option <?php echo $_GET['Carte'] == 'Nuke' ? 'selected' : ''; ?>>Nuke</option>
            <option <?php echo $_GET['Carte'] == 'Cobblestone' ? 'selected' : ''; ?>>Cobblestone</option>
            <option <?php echo $_GET['Carte'] == 'Lake' ? 'selected' : ''; ?>>Lake</option>
            <option <?php echo $_GET['Carte'] == 'Inferno' ? 'selected' : ''; ?>>Inferno</option>
            <option <?php echo $_GET['Carte'] == 'Train' ? 'selected' : ''; ?>>Train</option>
            <option <?php echo $_GET['Carte'] == 'Overpass' ? 'selected' : ''; ?>>Overpass</option>
            <option <?php echo $_GET['Carte'] == 'Rialto' ? 'selected' : ''; ?>>Rialto</option>
            <option <?php echo $_GET['Carte'] == 'Vertigo' ? 'selected' : ''; ?>>Vertigo</option>
            <option <?php echo $_GET['Carte'] == 'Elysion' ? 'selected' : ''; ?>>Elysion</option>
            <option <?php echo $_GET['Carte'] == 'Guard' ? 'selected' : ''; ?>>Guard</option>
            <option <?php echo $_GET['Carte'] == 'Shortdust' ? 'selected' : ''; ?>>Shortdust</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Afficher</button>
    </form>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Rang Yanic</th>
                <th>Rang Vivian</th>
                <th>Score</th>
                <th>Carte</th>
                <th>Résultat</th>
                <th>Rang ennemie 1</th>
                <th>Rang ennemie 2</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $keys => $value) { ?>
            <tr>
                <td><?php echo $value['Date']; ?></td>
                <td><?php echo $value['RankY']; ?></td>
                <td><?php echo $value['RankV']; ?></td>
                <td><?php echo $value['Score']; ?></td>
                <td><?php echo $value['Carte']; ?></td>
                <td><?php echo $value['Résultat']; ?></td>
                <td><?php echo $value['RankE1']; ?></td>
                <td><?php echo $value['RankE2']; ?></td>
                <td><?php echo $value['Info']; ?></td>
            </tr>
        <?php 
            $counter++; 
            } 
            echo "<h3>Nombre de lignes : " . $counter . "</h3>"
        ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
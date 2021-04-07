<?php 
    require '../utils/database.php'; 

    ini_set('display_errors', 1);

    $db = getDatabaseConnection();

    $sqlDays = "SELECT DATE_FORMAT(date,'%d/%m/%Y') as date, COUNT(DISTINCT date) as number FROM wingman GROUP BY date(date) ORDER BY COUNT(DISTINCT date) DESC LIMIT 11";
    $statement = $db->prepare($sqlDays);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $days = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }

    $sqlMaps = "SELECT (SELECT COUNT(DISTINCT date) FROM wingman) as total, map, COUNT(DISTINCT date) as number FROM wingman GROUP BY map ORDER BY COUNT(DISTINCT date) DESC";
    $statement = $db->prepare($sqlMaps);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $maps = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }

    $sqlResults = "SELECT DATE_FORMAT(datejour,'%d/%m/%Y') as date, Win, Lose, Draw FROM (SELECT date(matchDate) as datejour,SUM(CASE WHEN result = 'Victoire' THEN 1 ELSE 0 END) as Win, SUM(CASE WHEN result = 'Défaite' THEN 1 ELSE 0 END) as Lose,SUM(CASE WHEN result = 'Egalite' THEN 1 ELSE 0 END) as Draw from displayGames group by 1 ORDER BY 1 DESC LIMIT 7) as table1 order by 1 asc";
    $statement = $db->prepare($sqlResults);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $results = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../utils/head.php'; ?>
    <title>Statistiques</title>
</head>
<body>
    <?php include '../utils/header.php'; ?>
    <div class="container-fluid">
        <div class="row justify-content-evenly">
            <div class="col-lg-5">
                <div class="card border-dark text-center mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Jours</h4>
                        <p class="card-text">Les jours avec le plus de parties</p>
                    </div>
                </div>
                <?php foreach ($days as $key => $day) { ?>
                    <div class="row">
                        <div class="col col-8 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $day['date']; ?></p>
                        </div>
                        <div class="col col-4 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $day['number'];?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-5">
                <div class="card border-dark text-center mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Cartes</h4>
                        <p class="card-text">Les cartes les plus jouées</p>
                    </div>
                </div>
                <?php foreach ($maps as $key => $map) { ?>
                    <div class="row">
                        <div class="col col-8 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $map['map']; ?></p>
                        </div>
                        <div class="col col-4 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $map['number'];?></p>
                        </div>
                    </div>
                <?php } ?>
                <canvas id="maps"></canvas>
                <script>
                var mapsCtx = document.getElementById('maps');
                var mapsChart = new Chart(mapsCtx, {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: 'Victoire',
                            data: [<?php foreach ($maps as $key => $map) { echo "'" . round($map['number']/$map['total']*100,2) . "',"; } ?>],
                            backgroundColor:[
                                'rgba(38, 84, 124, 0.7)',
                                'rgba(60, 214, 168, 0.7)',
                                'rgba(95, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)',
                                'rgba(60, 214, 101, 0.7)'
                            ],
                            borderColor: [
                                'rgba(38, 84, 124, 1)',
                                'rgba(60, 214, 168, 1)',
                                'rgba(95, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)',
                                'rgba(60, 214, 101, 1)'
                            ],
                        }],
                        labels: [<?php foreach ($maps as $key => $map) { echo "'" . $map['map'] . "',"; } ?>]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>
            </div>
        </div>
        <div class="row mx-lg-5">
        <canvas id="results"></canvas>
            <script>
            var resultCtx = document.getElementById('results');
            var resultChart = new Chart(resultCtx, {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Victoire',
                        data: [<?php foreach ($results as $key => $result) { echo "'" . $result['Win'] . "',"; } ?>],
                        backgroundColor:[
                            'rgba(143, 227, 136, 0.4)',
                            'rgba(143, 227, 136, 0.4)',
                            'rgba(143, 227, 136, 0.4)',
                            'rgba(143, 227, 136, 0.4)',
                            'rgba(143, 227, 136, 0.4)',
                            'rgba(143, 227, 136, 0.4)',
                            'rgba(143, 227, 136, 0.4)'
                        ],
                        borderColor: [
                            'rgba(143, 227, 136, 1)',
                            'rgba(143, 227, 136, 1)',
                            'rgba(143, 227, 136, 1)',
                            'rgba(143, 227, 136, 1)',
                            'rgba(143, 227, 136, 1)',
                            'rgba(143, 227, 136, 1)',
                            'rgba(143, 227, 136, 1)'
                        ],
                    }, {
                        label: 'Défaite',
                        data: [<?php foreach ($results as $key => $result) { echo "'" . $result['Lose'] . "',"; } ?>],
                        backgroundColor:[
                            'rgba(232, 95, 92, 0.4)',
                            'rgba(232, 95, 92, 0.4)',
                            'rgba(232, 95, 92, 0.4)',
                            'rgba(232, 95, 92, 0.4)',
                            'rgba(232, 95, 92, 0.4)',
                            'rgba(232, 95, 92, 0.4)',
                            'rgba(232, 95, 92, 0.4)'
                        ],
                        borderColor: [
                            'rgba(232, 95, 92, 1)',
                            'rgba(232, 95, 92, 1)',
                            'rgba(232, 95, 92, 1)',
                            'rgba(232, 95, 92, 1)',
                            'rgba(232, 95, 92, 1)',
                            'rgba(232, 95, 92, 1)',
                            'rgba(232, 95, 92, 1)'
                        ],
                    }, {
                        label: 'Egalité',
                        data: [<?php foreach ($results as $key => $result) { echo "'" . $result['Draw'] . "',"; } ?>],
                        backgroundColor:[
                            'rgba(237, 150, 57, 0.4)',
                            'rgba(237, 150, 57, 0.4)',
                            'rgba(237, 150, 57, 0.4)',
                            'rgba(237, 150, 57, 0.4)',
                            'rgba(237, 150, 57, 0.4)',
                            'rgba(237, 150, 57, 0.4)',
                            'rgba(237, 150, 57, 0.4)'
                        ],
                        borderColor: [
                            'rgba(237, 150, 57, 1)',
                            'rgba(237, 150, 57, 1)',
                            'rgba(237, 150, 57, 1)',
                            'rgba(237, 150, 57, 1)',
                            'rgba(237, 150, 57, 1)',
                            'rgba(237, 150, 57, 1)',
                            'rgba(237, 150, 57, 1)'
                        ],
                    }],
                    labels: [<?php foreach ($results as $key => $result) { echo "'" . $result['date'] . "',"; } ?>]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            </script>
        </div>
    </div>
</body>
</html>
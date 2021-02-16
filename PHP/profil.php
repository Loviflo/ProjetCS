<?php 
    require '../utils/database.php';
    ini_set('display_errors', 1);
    $db = getDatabaseConnection();
    $sql = "SELECT COUNT(DISTINCT date), AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore),SUM(kills),SUM(assists),SUM(deaths),SUM(mvp),SUM(ud),SUM(ef),SUM(playerScore) FROM wingman WHERE playerName = 'Loviflo'";
    $statement = $db->prepare($sql);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    foreach ($rows as $keys => $value) {}

    $sql2 = "SELECT COUNT(DISTINCT date), AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore),SUM(kills),SUM(assists),SUM(deaths),SUM(mvp),SUM(ud),SUM(ef),SUM(playerScore) FROM wingman WHERE playerName = 'Ilesis'";
    $statement = $db->prepare($sql2);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    foreach ($rows as $keys => $value2) {}

    $ratio = $value['SUM(kills)']/$value['SUM(deaths)'];
    $ratio2 = $value2['SUM(kills)']/$value2['SUM(deaths)'];
    $values = ['AVG(kills)','AVG(assists)','AVG(deaths)','AVG(mvp)','AVG(hsp)','AVG(adr)','AVG(ud)','AVG(ef)','AVG(playerScore)','SUM(kills)','SUM(assists)','SUM(deaths)','SUM(mvp)','SUM(ud)','SUM(ef)','SUM(playerScore)'];
    $description = ['Moyenne des kills','Moyenne d\'assists','Moyenne des morts','Moyenne des MVP','Moyenne des HSP','Moyenne de l\'ADR','Moyenne des dégâts divers','Moyenne des ennemies flashés','Moyenne des scores','Total des kills','Total des assists','Total des morts','Total des MVP','Total des dégâts divers','Total des ennemies flashés','Total des scores'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../utils/head.php'; ?>
    <title>Profil</title>
</head>
<body>
    <?php include '../utils/header.php'; ?>
    <div class="container-fluid">
        <div class="row justify-content-evenly">
            <div class="col-xl-5">
                <div class="card border-dark text-center mt-3">
                  <img class="card-img-top" src="" alt="">
                  <div class="card-body">
                    <h4 class="card-title">Loviflo</h4>
                    <p class="card-text">Vivian</p>
                  </div>
                </div>
                <?php for ($i=0; $i < 16; $i++) { ?>
                    <div class="row">
                        <div class="col col-8 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $description[$i]; ?></p>
                        </div>
                        <div class="col col-4 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $value[$values[$i]] ?></p>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col col-8 col-lg-6">
                        <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded">Ratio</p>
                    </div>
                    <div class="col col-4 col-lg-6">
                        <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $ratio; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card border-dark text-center mt-lg-3">
                  <img class="card-img-top" src="holder.js/100px180/" alt="">
                  <div class="card-body">
                    <h4 class="card-title">Ilesis</h4>
                    <p class="card-text">Yanic</p>
                  </div>
                </div>
                <?php for ($i=0; $i < 16; $i++) { ?>
                    <div class="row">
                        <div class="col col-8 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $description[$i]; ?></p>
                        </div>
                        <div class="col col-4 col-lg-6">
                            <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $value2[$values[$i]] ?></p>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col col-8 col-lg-6">
                        <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded">Ratio</p>
                    </div>
                    <div class="col col-4 col-lg-6">
                        <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $ratio2; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
    require '../utils/database.php';
    ini_set('display_errors', 1);
    $db = getDatabaseConnection();
    
    $sql = "SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore),SUM(kills),SUM(assists),SUM(deaths),SUM(mvp),SUM(ud),SUM(ef),SUM(playerScore) FROM wingman WHERE playerName = 'Loviflo'";
    $statement = $db->prepare($sql);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }
    foreach ($rows as $keys => $value) {}

    $sql2 = "SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore),SUM(kills),SUM(assists),SUM(deaths),SUM(mvp),SUM(ud),SUM(ef),SUM(playerScore) FROM wingman WHERE playerName = 'Ilesis'";
    $statement = $db->prepare($sql2);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }
    foreach ($rows as $keys => $value2) {}

    $sqlLoviflo1Week = "SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Loviflo'";
    $statement = $db->prepare($sqlLoviflo1Week);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }
    foreach ($rows as $keys => $valueLoviflo1Week) {}
    
    $sqlLoviflo2Weeks = "SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) - 1 AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Loviflo'";
    $statement = $db->prepare($sqlLoviflo2Weeks);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }
    foreach ($rows as $keys => $valueLoviflo2Weeks) {}

    $sqlIlesis1Week = "SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Ilesis'";
    $statement = $db->prepare($sqlIlesis1Week);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }
    foreach ($rows as $keys => $valueIlesis1Week) {}

    $sqlIlesis2Weeks = "SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) - 1 AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Ilesis'";
    $statement = $db->prepare($sqlIlesis2Weeks);
    if($statement !== false){
        $success = $statement->execute();
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_BOTH);
        }
    }
    foreach ($rows as $keys => $valueIlesis2Weeks) {}

    $ratio = $value['SUM(kills)']/$value['SUM(deaths)'];
    $ratio2 = $value2['SUM(kills)']/$value2['SUM(deaths)'];
    $description = ['Moyenne des kills','Moyenne d\'assists','Moyenne des morts','Moyenne des MVP','Moyenne des HSP','Moyenne de l\'ADR','Moyenne des dégâts divers','Moyenne des ennemies flashés','Moyenne des scores','Total des kills','Total des assists','Total des morts','Total des MVP','Total des dégâts divers','Total des ennemies flashés','Total des scores'];

    for ($i=0; $i < 9; $i++) { 
        if ($valueLoviflo1Week[$i] > $valueLoviflo2Weeks[$i]) {
            $avg[$i][0] = '<i class="bi bi-arrow-up-right"></i>';
            $avg[$i][1] = 'success';
        } else if ($valueLoviflo1Week[$i] < $valueLoviflo2Weeks[$i]) {
            $avg[$i][0] = '<i class="bi bi-arrow-down-right"></i>';
            $avg[$i][1] = 'danger'; 
        } else {
            $avg[$i][0] = '<i class="bi bi-arrow-right"></i>';
            $avg[$i][1] = 'dark';
        }
    }

    for ($i=0; $i < 9; $i++) { 
        if ($valueIlesis1Week[$i] > $valueIlesis2Weeks[$i]) {
            $avg[$i][2] = '<i class="bi bi-arrow-up-right"></i>';
            $avg[$i][3] = 'success';
        } else if ($valueIlesis1Week[$i] < $valueIlesis2Weeks[$i]) {
            $avg[$i][2] = '<i class="bi bi-arrow-down-right"></i>';   
            $avg[$i][3] = 'danger';   
        } else {
            $avg[$i][2] = '<i class="bi bi-arrow-right"></i>';
            $avg[$i][3] = 'dark';
        }
    }
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
                <?php for ($i=0; $i < 16; $i++) {
                    if ($i < 9) { ?>
                        <div class="row">
                            <div class="col col-8 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $description[$i]; ?></p>
                            </div>
                            <div class="col col-4 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-<?php echo $avg[$i][1]; ?> rounded"><?php echo $value[$i]; echo $avg[$i][0]; ?></p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col col-8 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $description[$i]; ?></p>
                            </div>
                            <div class="col col-4 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $value[$i]; ?></p>
                            </div>
                        </div>
                    <?php } 
                } ?>
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
                <?php for ($i=0; $i < 16; $i++) {
                    if ($i < 9) { ?>
                        <div class="row">
                            <div class="col col-8 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $description[$i]; ?></p>
                            </div>
                            <div class="col col-4 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-<?php echo $avg[$i][3]; ?> rounded"><?php echo $value2[$i]; echo $avg[$i][2]; ?></p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col col-8 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $description[$i]; ?></p>
                            </div>
                            <div class="col col-4 col-lg-6">
                                <p class="text-center mt-1 pb-2 pt-2 border border-dark rounded"><?php echo $value2[$i]; ?></p>
                            </div>
                        </div>
                    <?php } 
                } ?>
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
<?php
    require_once '../utils/database.php';
    ini_set('display_errors', 1);
    $db = getDatabaseConnection();

    if (isset($_POST["import"])) {
    
        $fileName = $_FILES["file"]["tmp_name"];
        
        if ($_FILES["file"]["size"] > 0) {
            
            $file = fopen($fileName, "r");
            
            while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
    
                $id = "";
                if (isset($column[0])) {
                    $id = $column[0];
                }
                $playerName = "";
                if (isset($column[1])) {
                    $playerName = $column[1];
                }
                $ping = "";
                if (isset($column[2])) {
                    $ping = $column[2];
                }
                $kills = "";
                if (isset($column[3])) {
                    $kills = $column[3];
                }
                $assists = "";
                if (isset($column[4])) {
                    $assists = $column[4];
                }
                $deaths = "";
                if (isset($column[5])) {
                    $deaths = $column[5];
                }
                $mvp = "";
                if (isset($column[6])) {
                    $mvp = $column[6];
                }
                $hsp = "";
                if (isset($column[7])) {
                    $hsp = $column[7];
                }
                $adr = "";
                if (isset($column[8])) {
                    if (!empty($column[8])) {
                        $adr = $column[8];
                    } else {
                        $adr = "NULL";
                    }
                }
                $ud = "";
                if (isset($column[9])) {
                    if (!empty($column[9])) {
                        $ud = $column[9];
                    } else {
                        $ud = "NULL";
                    }
                }
                $ef = "";
                if (isset($column[10])) {
                    if (!empty($column[10])) {
                        $ef = $column[10];
                    } else {
                        $ef = "NULL";
                    }
                }
                $playerScore = "";
                if (isset($column[1])) {
                    $playerScore = $column[11];
                }
                $rank = "";
                if (isset($column[12])) {
                    if (!empty($column[12])) {
                        $rank = $column[12];
                    } else {
                        $rank = "NULL";
                    }
                }
                $map = "";
                if (isset($column[13])) {
                    $map = $column[13];
                }
                $date = "";
                if (isset($column[14])) {
                    $date = $column[14];
                }
                $waitTime = "";
                if (isset($column[15])) {
                    $waitTime = $column[15];
                }
                $matchDuration = "";
                if (isset($column[16])) {
                    $matchDuration = $column[16];
                }
                $matchScore = "";
                if (isset($column[17])) {
                    $matchScore = $column[17];
                }
                print_r($column);
                echo '<br>'.$column[0];
                $sqlInsert = "INSERT into wingman (id,playerName,ping,kills,assists,deaths,mvp,hsp,adr,ud,ef,playerScore,rank,map,date,waitTime,matchDuration,matchScore) VALUES ($id,'$playerName',$ping,$kills,$assists,$deaths,$mvp,$hsp,$adr,$ud,$ef,$playerScore,'$rank','$map','$date','$waitTime','$matchDuration','$matchScore')";
                echo $sqlInsert;
                $statement = $db->prepare($sqlInsert);
                if($statement !== false){
                    $success = $statement->execute();
                    if ($success) {
                        $type = "success";
                        $message = "CSV Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "CSV error";
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../utils/head.php'; ?>
    <title>Import</title>
</head>
<body>
    <?php include '../utils/header.php'; ?>
    <div id="response"
    class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
    <?php if(!empty($message)) { echo $message; } ?>
</div>
<form action="test.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="">Fichier CSV</label>
      <input type="file" class="form-control-file" name="file" id="file" accept=".csv">
    </div>
    <button type="submit" name="import" class="btn btn-primary">Envoyer</button>
</form>
</body>
</html>
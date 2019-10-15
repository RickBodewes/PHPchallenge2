<?php
    require "../increq/PDOcon.php";

    $soort;
    $aapidIn;

    if(isset($_GET['aapid'])){
        $value = $_GET['aapid'];
        
        $query = "SELECT * FROM aap WHERE idaap LIKE :aapid LIMIT 1";
        $stmt = $con->prepare($query);
        $stmt->bindvalue(':aapid', '%' . $value . '%');
        $stmt->execute();
        if($stmt->rowcount() != 0){
            $stmt = $stmt->fetch();
            $soort = $stmt['soort'];
            $aapidIn = $stmt['idaap'];
        }
    }

    if(isset($_POST['aapid'])){
        $value = $_POST['aapid'];
        unset($_POST['aapid']);
        
        $query = "DELETE FROM aap_has_leefgebied WHERE idaap = :idaap";
        $stmt = $con->prepare($query);
        $stmt->bindvalue(':idaap', $value);
        $stmt->execute();
        
        foreach($_POST as $habitatID){
            $query = "INSERT INTO aap_has_leefgebied (idaap, idleefgebied) VALUES (:aapid, :leefgebiedid);";
            $stmt = $con->prepare($query);
            $stmt->bindvalue(':aapid', $aapidIn);
            $stmt->bindvalue(':leefgebiedid', $habitatID);
            $stmt->execute();
        }
        header("location: index.php");


    }
    
?>
<!DOCTYPE html>
<html>

<head>
    <title>opdracht 10</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Bangers&display=swap');

        #wrapper {
            margin: auto;
            max-width: 1200px;
        }

        #wrapper ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: black;
        }
        
        #scrollBox{
            height: 200px;
            width: 300px;
            border: solid 1px black;
            overflow: scroll;
            margin: 10px 0;
        }
        
        #currentHabitatList{
            height: 150px;
            width: 300px;
            border: solid 1px black;    
            overflow: scroll;
            margin: 10px 0;
        }

    </style>
</head>

<body>
    <div id="wrapper">
        <form method="post">
            <input type="hidden" name="aapid" value="<?php echo strip_tags($aapidIn); ?>">
            <?php echo isset($soort) ? "de aap die u gaat aanpassen " . strip_tags($soort) : "geen aap gevonden"; ?>
            <div id="scrollBox">
                <ul>
                    <?php
                    $i = 0;
                    $query = "SELECT * FROM leefgebied";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $stmt->fetch()){
                        $i++;
                        echo "<li><input type='checkbox' value='". strip_tags($row['idleefgebied']) ."' name='opt". $i ."'>". strip_tags($row['omschrijving']) ."</li>";
                    }
                ?>
                </ul>
            </div>
            <input type="submit">
        </form>
        huidige leefgebieden
        <div id="currentHabitatList">
            <ul>
                <?php
                    if(isset($_GET['aapid'])){
                        $query = "SELECT leefgebied.omschrijving FROM aap_has_leefgebied INNER JOIN leefgebied ON leefgebied.idleefgebied = aap_has_leefgebied.idleefgebied WHERE aap_has_leefgebied.idaap = :aapid";
                        $stmt = $con->prepare($query);
                        $stmt->bindvalue(":aapid", $_GET['aapid']);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while($row = $stmt->fetch()){
                            $i++;
                            echo "<li>". strip_tags($row['omschrijving']) ."</li>";
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>

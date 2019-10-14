<?php
    require "../increq/PDOcon.php";

    if(isset($_GET['aapnaam'])){
        $value = $_GET['aapnaam'];
        unset($_GET['aapnaam']);
        
        $query = "SELECT idaap FROM aap WHERE soort = :aapnaam";
        $stmt = $con->prepare($query);
        $stmt->bindvalue(':aapnaam', $value);
        $stmt->execute();
        if($stmt->rowcount() == 0){
            $query = "INSERT INTO aap (soort) VALUES (:aapnaam)";
            $stmt = $con->prepare($query);
            $stmt->bindvalue(':aapnaam', $value);
            $stmt->execute();
            
            
            $query = "SELECT idaap FROM aap WHERE soort = :aapnaam";
            $stmt = $con->prepare($query);
            $stmt->bindvalue(':aapnaam', $value);
            $stmt->execute();
            $stmt = $stmt->fetch();
            $aapid = $stmt['idaap'];
            
            foreach($_GET as $habitatID){
                $query = "INSERT INTO aap_has_leefgebied (idaap, idleefgebied) VALUES (:aapid, :leefgebiedid);";
                $stmt = $con->prepare($query);
                $stmt->bindvalue(':aapid', $aapid);
                $stmt->bindvalue(':leefgebiedid', $habitatID);
                $stmt->execute();
            }
            
        }else{
            echo "dit soort aap bestaat al in deze database";
        }

    }

?>
<!DOCTYPE html>
<html>

<head>
    <title>opdracht 9</title>
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

    </style>
</head>

<body>
    <div id="wrapper">
        <form method="get">
            <input type="text" name="aapnaam" required>
            <ul>
                <?php
                    $i = 0;
                    $query = "SELECT * FROM leefgebied";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $stmt->fetch()){
                        $i++;
                        echo "<li><input type='checkbox' value='". $row['idleefgebied'] ."' name='opt". $i ."'>". $row['omschrijving'] ."</li>";
                    }
                ?>
            </ul>
            <input type="submit">
        </form>
    </div>
</body>

</html>

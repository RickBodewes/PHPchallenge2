<?php
    require "../increq/PDOcon.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>opdracht 12</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Bangers&display=swap');
        #wrapper {
            margin: auto;
            max-width: 1200px;
        }

        #header {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    </style>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <span><img src="../imgs/monkey-business.jpg"></span>
            <img src="../imgs/monkey_swings.png">
        </div>
        <div id="list_content">
            <table border="1" style="width: 100%;">
                
                <?php
                    $query = "SELECT aap_has_leefgebied.idleefgebied, leefgebied.omschrijving, COUNT(*) FROM aap_has_leefgebied JOIN leefgebied ON aap_has_leefgebied.idleefgebied = leefgebied.idleefgebied GROUP BY aap_has_leefgebied.idleefgebied";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $stmt->fetch()){
                        echo "<tr>";
                        echo "<td>" . $row['omschrijving'] . "</td>";
                        
                        $query = "SELECT aap.soort FROM aap_has_leefgebied JOIN aap ON aap_has_leefgebied.idaap = aap.idaap WHERE aap_has_leefgebied.idleefgebied = :idleefgebied";     
                        $stmt2 = $con->prepare($query);
                        $stmt2->bindvalue(":idleefgebied", $row['idleefgebied']);
                        $stmt2->execute();
                        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                        echo "<td>";
                        while($row2 = $stmt2->fetch()){
                            echo $row2['soort'] . ", ";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</body>

</html>

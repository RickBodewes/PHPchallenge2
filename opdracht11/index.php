<?php
    require "../increq/PDOcon.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>opdracht 11</title>
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

        #list_content {
            display: flex;
            justify-content: center;
        }

        #list_content ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #FF8400;
            font-family: 'Bangers', 'arial';
            font-size: 35px;
            font-weight: 700;
        }

        #list_content ul li a {
            text-decoration: none;
            color: #FF8400;
            font-family: 'Bangers', 'arial';
            font-size: 35px;
            font-weight: 700;
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
                    $query = "SELECT leefgebied.omschrijving, COUNT(*) FROM aap_has_leefgebied JOIN leefgebied ON aap_has_leefgebied.idleefgebied = leefgebied.idleefgebied GROUP BY aap_has_leefgebied.idleefgebied";     
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $stmt->fetch()){
                        echo "<tr>";
                        echo "<td>" . $row['omschrijving'] . "</td>";
                        echo "<td>" . $row['COUNT(*)'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</body>

</html>

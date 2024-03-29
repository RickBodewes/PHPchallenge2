<?php
    require "../increq/PDOcon.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>opdracht 6</title>
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
            <ul>
                <?php
                    $query = "SELECT aap.soort, leefgebied.omschrijving FROM ((aap_has_leefgebied INNER JOIN aap ON aap_has_leefgebied.idaap = aap.idaap) INNER JOIN leefgebied ON aap_has_leefgebied.idleefgebied = leefgebied.idleefgebied)";                    
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $stmt->fetch()){
                        echo "<li><a href='https://www.google.nl/search?q=" . htmlentities($row['omschrijving']) . "&tbm=isch'>" . htmlentities($row['omschrijving']) . "</a> - <a href='https://www.google.nl/search?q=" . htmlentities($row['soort']) . "&tbm=isch'>" . htmlentities($row['soort']) . "</a></li>";
                    }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>

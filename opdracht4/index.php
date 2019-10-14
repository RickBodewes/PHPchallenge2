<?php
    require "../increq/PDOcon.php";

    $apen = array("Baviaan", "Guereza", "Langoer", "Neusaap", "Tamarin", "Brulaap", "Halfaap", "Mandril");
?>
<!DOCTYPE html>
<html>

<head>
    <title>opdracht 4</title>
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
                    $query = "SELECT omschrijving FROM leefgebied";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $stmt->fetch()){
                        echo "<li><a href='https://www.google.nl/search?q=" . $row['omschrijving'] . "&tbm=isch'>" . $row['omschrijving'] . "</a></li>";
                    }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>

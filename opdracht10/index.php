<?php
    require "../increq/PDOcon.php";

    if(isset($_GET['aapnaam'])){
        $value = $_GET['aapnaam'];
        unset($_GET['aapnaam']);
        
        $query = "SELECT idaap FROM aap WHERE soort LIKE :aapnaam LIMIT 1";
        $stmt = $con->prepare($query);
        $stmt->bindvalue(':aapnaam', '%' . $value . '%');
        $stmt->execute();
        if($stmt->rowcount() != 0){
            $stmt = $stmt->fetch();
            $aapid = $stmt['idaap'];
            header("location: edit.php?aapid=" . $aapid);
        }else{
            echo "dit soort aap bestaat niet in deze database";
        }

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


    </style>
</head>

<body>
    <div id="wrapper">
        <form method="get">
            <input type="text" name="aapnaam" required>

            <input type="submit">
        </form>
    </div>
</body>

</html>

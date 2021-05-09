<?php

require("../../../../configuration.php");
require("fnc_news.php");



$newsHTML = readNews(1);

if (isset($_POST["newsDelBtn"])) {
    deleteNews($_POST["newsDelBtn"]);
    $newsHTML = readNews($_POST["limitSet"]);
}

if (isset($_POST["limitSet"])) {

    $newsHTML = readNews($_POST["limitSet"]);
}

?>

<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veebirakendused ja nende loomine 2020</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-color:orange;">

    <div class="container" style="max-width: 60%; margin-top:100px;">

        <section class="text-center">
            <h1 class="jumbotron-heading">Uudised</h1>
            <p class="lead text-muted">See leht on valminud õppetöö raames!</p>
            <br>
        </section>

        <div>
            <section class="text-center">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="limit"></label>
                    <?php
                    $aDropd = array("1", "5", "10", "100");
                    echo '<div class="form-group col-md-4">
                    <label for="limit">Vali, mitu uudist soovid kuvada:</label>  
                    <select id="limit" class="form-control" onchange="this.form.submit();" name="limitSet">';
                    foreach ($aDropd as $sOption) {
                        $sSel = ($sOption == $_POST['limitSet']) ? "Selected='selected'" : "";
                        echo "<option   $sSel>$sOption</option>";
                    }
                    echo '</select></div>';
                    echo '<div>';
                    echo $newsHTML;
                    echo '</div>';
                    ?>
                </form>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
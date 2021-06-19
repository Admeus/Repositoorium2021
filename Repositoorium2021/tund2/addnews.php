<?php

//require(); Annab fatal errori siis miski ei tööta.
//include(); Jätkab tegevust, kui ei ole faili.

require("../../../../configuration.php");
require("fnc_news.php");

// var_dump($_POST);
// echo $_POST["newsTitle"];
$newsTitle  = null;
$newsContent = null;
$newsError = null;

if (isset($_POST["newsBtn"])) {

    if (isset($_POST["newsTitle"]) and !empty(test_input($_POST["newsTitle"]))) {
        $newsTitle = test_input($_POST["newsTitle"]);
    } else {
        $newsError = "Uudise pealkiri on sisestamata! ";
    }

    if (isset($_POST["newsEditor"]) and !empty(test_input($_POST["newsEditor"]))) {
        $newsContent = test_input($_POST["newsEditor"]);
    } else {
        $newsError .= "Uudise sisu on sisestamata! ";
    }

    //Saadame andmebaasi
    if (empty($newsError)) {
        //echo "Salvestame";
        $response = saveNews($newsTitle, $newsContent);

        if ($response == 1) {
            $newsError = "Uudis on salvestatud!";
        } else {
            $newsError = "Uudise salvestamisel tekkis tõrge!";
        }
    }
}


// GET puhul pannakse kõik url ribale :(
// POST puhul urlile ei lisata (turvalisem, mitte absoluutselt). Saab lisada pilte jms, piirangut pole (eelistatud)
// submit puhul on spetsiaalne massiiv $_GET, $_POST
// span on hea tektsi element, mis ei alusta uut rida

//https://www.w3schools.com/php/php_form_validation.asp


?>

<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veebirakendused ja nende loomine 2021</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-color:orange;">

    <div class="container" style="max-width: 60%; margin-top:100px;">

        <section class="text-center">
            <h1 class="jumbotron-heading">Uudise lisamine</h1>
            <p class="lead text-muted">See leht on valminud õppetöö raames!</p>
            <br>
        </section>


        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Uudise pealkiri:</label>
            <br>
            <input type="text" class="form-control" name="newsTitle" placeholder="Uudise pealkiri" value="<?php echo $newsTitle; ?>"><br>
            <br>
            <label>Uudise sisu:</label><br>
            <textarea class="form-control" name="newsEditor" placeholder="Uudis sisesta siia" rows="6" cols="40"><?php echo $newsContent; ?></textarea><br>
            <br>
            <input type="submit" class="btn btn-secondary" name="newsBtn" value="Salvesta uudis!">
            <span><?php echo $newsError; ?></span>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
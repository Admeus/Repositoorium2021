<?php

require("../../../../configuration.php");
require("fnc_news.php");

$studyTopicsOptions = getStudyTopicsOptions();
$studyActivitiesOptions = getStudyActivitiesOptions();

$studyTopicId = null;
$studyActivity = null;
$elapsedTime = null;
$studyError = null;

if (isset($_POST['studyBtn'])) {

    if (isset($_POST["studyTopicId"]) and !empty(test_input($_POST["studyTopicId"]))) {
        $studyTopicId = test_input($_POST["studyTopicId"]);
    } else {
        $studyError .= "Õppeaine on valimata! ";
    }

    if (isset($_POST["studyActivity"]) and !empty(test_input($_POST["studyActivity"]))) {
        $studyActivity = test_input($_POST["studyActivity"]);
    } else {
        $studyError .= "Tegevus on valimata! ";
    }

    if (isset($_POST["elapsedTime"]) and !empty(test_input($_POST["elapsedTime"])) and $_POST["elapsedTime"] != 0) {
        $elapsedTime = test_input($_POST["elapsedTime"]);
    } else {
        $studyError .= "Tegevusele kulund aeg on määramata! ";
    }

    //Saadame andmebaasi
    if (empty($studyError)) {

        $response = saveStudy($studyTopicId, $studyActivity, $elapsedTime);

        if ($response == 1) {
            $studyError = "Tegevus on salvestatud";
        } else {
            $studyError = "Tegevuse salvestamisel tekkis tõrge!";
        }
    }
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

<body>

    <div class="container" style="max-width: 60%; margin-top:100px;">
        <section class="text-center">

            <section class="text-center">
                <h1 class="jumbotron-heading">Õppetegevuse sisestamine</h1>
                <p class="lead text-muted">See leht on valminud õppetöö raames!</p>
                <br>
            </section>

            <div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control" name="studyTopicId">
                                <option value="" selected disabled>Õppeaine</option>
                                <?php echo $studyTopicsOptions; ?>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="studyActivity">
                                <option value="" selected disabled>Tegevus</option>
                                <?php echo $studyActivitiesOptions; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <br>
                            <label>Tegevusele kulunud aeg:</label>
                            <input class="form-control" type="number" min=".25" max="24" step=".25" name="elapsedTime">
                        </div>
                    </div><br>
                    <input type="submit" class="btn btn-secondary" name="studyBtn" value="Salvesta tegevus!"><br><br>
                    <span><?php echo $studyError; ?></span>
                </form>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
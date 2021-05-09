<?php

require("../../../../configuration.php");
require("fnc_news.php");

$studyTableHTML = getStudyTableHTML();

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
    <div class="container" style="max-width: 80%; margin-top:100px;">
        <section class="text-center">
            <h1 class="jumbotron-heading">Õppetegevuse info</h1>
            <p class="lead text-muted">See leht on valminud õppetöö raames!</p>
            <br>
        </section>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Õppeaine</th>
                    <th scope="col">Tegevus</th>
                    <th scope="col">Kulunud aeg</th>
                    <th scope="col">Kuupäev</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $studyTableHTML; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
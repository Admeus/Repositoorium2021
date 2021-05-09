<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function saveNews($newsTitle, $newsContent)
{

    $response = null;
    //Loon andmebaasi ühenduse
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    //Valmistan ette SQL päringu
    $stmt = $conn->prepare("INSERT INTO vr20_news (userid, title, content) VALUES (?, ?, ?)");
    echo $conn->error;

    //Seon päringuga tegelikud andmed

    $userid = 1;
    // i - integer
    // s - string
    // d - decimal
    $stmt->bind_param("iss", $userid, $newsTitle, $newsContent);

    if ($stmt->execute()) {
        $response = 1;
    } else {
        $response = 0;
        echo $stmt->error;
    }

    //Sulgen päringu ja andmebaasi ühenduse.
    $stmt->close();
    $conn->close();
    return $response;
}

function readNews($limit)
{
    $response = null;
    //Loon andmebaasi ühenduse
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    $stmt = $conn->prepare("SELECT id, title, content, created FROM vr20_news where deleted is null order by id desc LIMIT ?");
    echo $conn->error;

    $stmt->bind_param("i", $limit);
    $stmt->bind_result($idFromDB, $titleFromDB, $contentFromDB, $dateFromDB);
    $stmt->execute();
    //if($stmt->fetch()) //nat kas selline asi on olemas??? saab kasutada ühe saaduse kontrollimiseks.
    while ($stmt->fetch()) {
        //<h2>uudise pealkiri<h1>
        //<p>uudis<p>
        $response .= '<div class="jumbotron">';
        $response .= '<h3 class="display-4">' . $titleFromDB . '</h3>';
        $response .= '<p class="lead">' . $dateFromDB . '</p>';
        $response .= '<hr class="my-4">';
        $response .= '<p>' . $contentFromDB . '</p>';
        $response .= '<p class="lead">';
        $response .= '<form method="post" action=""><button class="btn btn-secondary" type="submit" name="newsDelBtn" value="' . $idFromDB . '">Kustuta</button></from>';
        $response .= '</p>';
        $response .= '</div>';
    }

    if ($response == null) {
        $response = "<p>Kahjuks uudised puuduvad!</p>";
    }

    $stmt->close();
    $conn->close();
    return $response;
}

function deleteNews($id)
{
    $response = null;

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("UPDATE vr20_news SET deleted = NOW() WHERE Id =?");

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response = 1;
    } else {
        $response = 0;
        echo $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $response;
}

function getStudyTopicsOptions()
{

    $response = null;

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    mysqli_set_charset($conn, "utf8");

    $stmt = $conn->prepare("SELECT id, course FROM vr20_studytopics order by course asc");
    echo $conn->error;

    $stmt->bind_result($idFromDB, $courseNameFromDB);
    $stmt->execute();


    while ($stmt->fetch()) {
        $response .= '<option value="' . $idFromDB . '">' . $courseNameFromDB . '</option>\n';
    }

    if ($response == null) {
        $response = "Kursuste nimed puuduvad!";
    }

    $stmt->close();
    $conn->close();
    return $response;
}

function getStudyActivitiesOptions()
{

    $response = null;

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    mysqli_set_charset($conn, "utf8");

    $stmt = $conn->prepare("SELECT id, activity FROM vr20_studyactivities order by activity asc");
    echo $conn->error;

    $stmt->bind_result($idFromDB, $activityNameFromDB);
    $stmt->execute();


    while ($stmt->fetch()) {
        $response .= '<option value="' . $idFromDB . '">' . $activityNameFromDB . '</option>\n';
    }

    if ($response == null) {
        $response = "Tegevuste nimed puuduvad!";
    }

    $stmt->close();
    $conn->close();
    return $response;
}

function saveStudy($studyTopicId, $studyActivity, $elapsedTime)
{

    $response = null;
    //Loon andmebaasi ühenduse
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    //Valmistan ette SQL päringu
    $stmt = $conn->prepare("INSERT INTO vr20_studylog (course, activity, time) VALUES (?, ?, ?)");
    echo $conn->error;

    //Seon päringuga tegelikud andmed

    // i - integer
    // s - string
    // d - decimal
    $stmt->bind_param("isd", $studyTopicId, $studyActivity, $elapsedTime);

    if ($stmt->execute()) {
        $response = 1;
    } else {
        $response = 0;
        echo $stmt->error;
    }

    //Sulgen päringu ja andmebaasi ühenduse.
    $stmt->close();
    $conn->close();
    return $response;
}

function getStudyTableHTML()
{

    $response = null;

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    mysqli_set_charset($conn, "utf8");

    $stmt = $conn->prepare("SELECT sl.id, st.course, sa.activity, time, day 
                                FROM vr20_studylog sl 
                                JOIN vr20_studytopics st on sl.course=st.id
                                JOIN vr20_studyactivities sa on sl.activity=sa.id
                                order by id asc");
    echo $conn->error;

    $stmt->bind_result($idFromDB, $courseNameFromDB, $activityNameFromDB, $elapsedTimeFromDB, $dateFromDB);
    $stmt->execute();

    $rowCount = 1;
    while ($stmt->fetch()) {

        $response .= '<tr>
        <th scope="row">' . $rowCount . '</th>
        <td>' . $courseNameFromDB . '</td>
        <td>' . $activityNameFromDB . '</td>
        <td>' . $elapsedTimeFromDB . '</td>
        <td>' . $dateFromDB . '</td>
        </tr>';

        $rowCount += 1;
    }

    if ($response == null) {
        $response = "Ühtegi tegevust ei ole lisatud!";
    }

    $stmt->close();
    $conn->close();
    return $response;
}

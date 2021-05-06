<?php

$myname 		= 'Ainar Kiison';
$fulltimenow	= date("d.m.Y H:i:s");
$timeHTML		= "<p>Lehe avamise hetkel oli aeg: <strong>$fulltimenow</strong></p>";
$hourNow		= date("H");
$partOfDay		= "külm aeg";

if ($hourNow < 10) {
	$partOfDay = 'hommik';
} elseif ($hourNow >= 10 && $hourNow < 18) {
	$partOfDay = 'aeg aktiivselt tegutseda';
}

$partOfDayHTML = "<p>Käes on $partOfDay!</p> \n";

//taust 
if ($hourNow > 6 && $hourNow < 12) {
	$bgclass = '"morning"';
} else {
	$bgclass = '"night"';
}

// semestri läbivus
$semesterStart = new DateTime("2021-01-27");
$semesterEnd = new DateTime("2021-06-22");
$semesterDuration = $semesterStart->diff($semesterEnd);
$today = new DateTime("Now");
$fromSemesterStart = $semesterStart->diff($today);

if($today < $semesterStart) {
	$semesterProgressHTML = '<p>Semester ei ole veel alanud!</p>';
} elseif ($today > $semesterEnd) {
	$semesterProgressHTML = '<p>Semester on ammu läbi!</p>';
} else {
	$semesterProgressHTML = '<p>Semester on veel hoos: <meter min="0" max="';
	$semesterProgressHTML .= $semesterDuration->format("%r%a");
	$semesterProgressHTML .= '" value="';
	$semesterProgressHTML .= $fromSemesterStart->format("%r%a");
	$semesterProgressHTML .= '"></meter></p>' . "\n";
}

// Pildikaust

$picsDir = "../../pics/";
$photoTypesAllow = ['image/jpeg', 'image/png'];
$allFiles = array_slice(scandir($picsDir), 2);
$photoList = [];

foreach ($allFiles as $file) {
	$fileInfo = getimagesize($picsDir . $file);
	if (in_array($fileInfo["mime"], $photoTypesAllow)) {
		array_push($photoList, $file);
	}
}

$photoCount = count($photoList);

if($photoCount!=0){
	$randomIMGList = [];
	$randomImgHTML = '';

	do {
		$randomIMG = $photoList[mt_rand(0, $photoCount - 1)];
		if(!in_array($randomIMG, $randomIMGList)){
			array_push($randomIMGList, $randomIMG);
			$randomImgHTML .= '<img src="' . $picsDir . $randomIMG . '" alt="Juhuslik Pilt Haapsalust"></img>' . "\n";
		} 
	} while (count($randomIMGList)<=2);

} else {
	$randomImgHTML = '<p>Ühtegi pilti pole, mida kuvada</p>';
}

?>

<!DOCTYPE html>
<html lang="et">

<head>
	<meta charset="utf-8">
	<title>VR 2021</title>
</head>
<style>
	.morning {
		background-color: yellow;
	}

	.night {
		background-color: darkgray;
	}
</style>
<body class=<?php echo $bgclass; ?>>
	<h1><?php echo $myname; ?></h1>
	<p>See leht on valminud õppetöö raames!!!</p>
	<?php
	echo $timeHTML . $partOfDayHTML . $semesterProgressHTML . $randomImgHTML;

	?>
</body>

</html>
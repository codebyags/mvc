<?php
function declOfNum($number, $titles)
{
	$cases = array (2, 0, 1, 1, 1, 2);
	$format = $titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
	return sprintf($format, $number);
}


function weekdaysToRus($weekdays, $am = false) {
	$arReturn = [];

	//mon,tue,wen,thu,fri,sat
	$enToRus = [
		'mon' => 'Понедельник',
		'tue' => 'Вторник',
		'wen' => 'Среда',
		'thu' => 'Четверг',
		'fri' => 'Пятница',
		'sat' => 'Суббота',
		'sun' => 'Воскресенье',
	];

	if($am) {
		$enToRus = [
			'mon' => 'Понедельникам',
			'tue' => 'Вторникам',
			'wen' => 'Средам',
			'thu' => 'Четвергам',
			'fri' => 'Пятницам',
			'sat' => 'Субботам',
			'sun' => 'Воскресеньям',
		];
	}

	foreach($weekdays as $day) {
		if( isset($enToRus[$day]) ) {
			$arReturn[] = $enToRus[$day];
		}
	}

	return implode(', ', $arReturn);
}


function priceFormat($number) {
	return number_format(+$number, 0, ',', ' ') . " руб.";
}


function filesize_format($filesize)
{
	$formats = array('Б','КБ','МБ','ГБ','ТБ');// варианты размера файла
	$format = 0;// формат размера по-умолчанию
	// прогоняем цикл
	while ($filesize > 1024 && count($formats) != ++$format)
	{
		$filesize = round($filesize / 1024, 2);
	}
	$formats[] = 'ТБ';
	return $filesize.$formats[$format];
}
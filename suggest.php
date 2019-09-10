<?php 
function YaaniSuggest($q,$max = 100,$lang="tr-TR")
{
	$q = empty($q) ? "???":$q;
	$q = explode(" ", $q);
	$q = implode("+", $q);

	$ch = curl_init("https://asgs.yaani.com.tr/suggest?q=$q&lang=$lang&max=$max");
	curl_setopt_array($ch, [
		CURLOPT_RETURNTRANSFER => True,
		CURLOPT_SSL_VERIFYPEER => False
	]);
	$results = curl_exec($ch);
	curl_close($ch);

	$results = json_decode($results,true);
	$output = [[]];
	foreach ($results as $value) 
	{
		if (!is_array($value)) 
		{	
			array_unshift($output, $value);
		}else
		{
			array_push($output[1], $value[0]);
		}
	}
	return [
		"search" => $output[0],
		"suggest" => $output[1]
	];
}

?>

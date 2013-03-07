<?
function decode_unicode($str) {
	$rep = array(
         "\u0105" => "ą",
         "\u0119" => "ę",
         "\u00F3" => "ó",
         "\u015B" => "ś",
         "\u0107" => "ć",
         "\u017C" => "ż",
         "\u017A" => "ź",
         "\u0144" => "ń",
         "\u0142" => "ł",
         "\u0104" => "Ą",
         "\u0118" => "Ę",
         "\u00D3" => "Ó",
         "\u015A" => "Ś",
         "\u0106" => "Ć",
         "\u017B" => "Ż",
         "\u0179" => "Ź",
         "\u0143" => "Ń",
         "\u0141" => "Ł");
		 $str = str_ireplace('&nbsp;', ' ', $str);
		 return str_ireplace(array_keys($rep), array_values($rep), $str);
}
require_once('ePF_API/ep_API.php');
DEFINE('Z', 100);
setlocale(LC_ALL, 'pl_PL', 'pl', 'Polish_Poland.28592');
$fp = fopen('data.json', 'w');
$dataset = new ep_Dataset( 'kody_pocztowe' );
echo 'Zapis do pliku...\n';
for($i=0;$i<1000000;$i+=100) {
	$kody_pocztowe = $dataset->find_all(Z,$i);
	for($x=0;$x<Z;$x++) {
		if($kody_pocztowe[$x]->data==NULL) break 2;
		fwrite($fp, decode_unicode(json_encode($kody_pocztowe[$x]->data)));
		fwrite($fp, "\n");
	}
	
}
fclose($fp);
echo 'Zapisano :)';
?>
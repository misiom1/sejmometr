<?
function decode_unicode($str) {
	$rep = array(
         "\u0105" => "�",
         "\u0119" => "�",
         "\u00F3" => "�",
         "\u015B" => "�",
         "\u0107" => "�",
         "\u017C" => "�",
         "\u017A" => "�",
         "\u0144" => "�",
         "\u0142" => "�",
         "\u0104" => "�",
         "\u0118" => "�",
         "\u00D3" => "�",
         "\u015A" => "�",
         "\u0106" => "�",
         "\u017B" => "�",
         "\u0179" => "�",
         "\u0143" => "�",
         "\u0141" => "�");
		 $str = str_ireplace('&nbsp;', ' ', $str);
		 return str_ireplace(array_keys($rep), array_values($rep), $str);
}
require_once('ePF_API/ep_API.php');
DEFINE('Z', 100);
setlocale(LC_ALL, 'pl_PL', 'pl', 'Polish_Poland.28592');
$fp = fopen('data.txt', 'w');
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
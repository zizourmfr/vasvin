<?php
 
$dbfile = "count.db";  // adatbázis helyének meghatározása
 
header("Content-Type: text/javascript");
 
if(!file_exists($dbfile)) {
	die("document.writeln(\"Hiba: Az adatfájl " . $dbfile . " NEM TALÁLHATÓ!\");");
}
 
if(!is_writable($dbfile)) {
	die("document.writeln(\"Hiba: Az adatfájl " . $dbfile . " NEM ÍRHATÓ! Adj neki 666-os jogosultságot! CHMOD 666\");");
}
 
function CountVisits() {
	global $dbfile;
	$cur_ip = getIP();
	
	$dbary = unserialize(file_get_contents($dbfile));
	if(!is_array($dbary) || !in_array($cur_ip, $dbary)) { // új IP
		$dbary[] = $cur_ip;
		
		$fp = fopen($dbfile, "w");
		fputs($fp, serialize($dbary));
		fclose($fp);
	}
	
	$out = sprintf("%09d", count($dbary)); // a számláló megjelenítésekor hány karaktert használjon? Itt most 9 van meghatározva.
	return $out;
}
 
function getIP() {
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	elseif(isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
	else $ip = "0";
	return $ip;
}
 
$total_visits = CountVisits();
?>
document.writeln("Az összes látogató száma: <b><?=$total_visits;?><\/b>");
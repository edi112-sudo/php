<?php 

$res="\033[0m";
$hitam="\033[0;30m";
$abu2="\033[1;30m";
$putih="\033[0;37m";
$putih2="\033[1;37m";
$red="\033[0;31m";
$red2="\033[1;31m";
$green="\033[0;32m";
$green2="\033[1;32m";
$yellow="\033[0;33m";
$yellow2="\033[1;33m";
$blue="\033[0;34m";
$blue2="\033[1;34m";
$purple="\033[0;35m";
$purple2="\033[1;35m";
$lblue="\033[0;36m";
$lblue2="\033[1;36m";

system('clear');
echo "User-Agent : "; $ua=trim(fgets(STDIN));

system('clear');
echo "Cookie : "; $cook=trim(fgets(STDIN));

function get($url,$header){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip deflate');
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;
}

function post($url,$header,$data){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip deflate');
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;
}

function dashboard($ua,$cook) {
	$header = [
		'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
		'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
		'cookie: '.$cook,
		'user-agent: '.$ua
	];
	$url = 'https://faucet-dogecoin.xyz/';

	return get($url,$header);
}

function claim($ua,$cook,$token) {
	$header = [
		'accept: application/json, text/javascript, */*; q=0.01',
		'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
		'content-type: application/x-www-form-urlencoded; charset=UTF-8',
		'cookie: '.$cook,
		'origin: https://faucet-dogecoin.xyz',
		'referer: https://faucet-dogecoin.xyz/',
		'user-agent: '.$ua
	];
	$url = 'https://faucet-dogecoin.xyz/system/ajax.php';
	$data = 'a=getFaucet&token='.$token.'&challenge=false&response=false';

	return post($url,$header,$data);
}

system('clear');

$green2.system("toilet --width 28 -f pagga -F border  'Bundle Channel'");

echo "$putih2 =================================================================\n";
echo $putih2." TANGGAL ".$green2.date("d.m.Y ").$putih2."  JAM ".$green2.date("H:i:s");
echo "\n ===============================\033[1;31m404\033[1;32m===============================";
echo "
$putih2 •Channel YT     :$green2 Bundle Channel

$putih2 =================================================================
$red2 •SCRIPT NOT FOR SALE •SCRIPT GRATIS GUNAKAN DENGAN BIJAK YA CUK
 •SEGALA RESIKO DI TANGGUNG PENGGUNA\n";
echo $blue2." •••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••\n\n";



$dashboard = dashboard($ua,$cook);

$nama = explode('<font class="text-success">', $dashboard)[1];
$nama = explode('</font><br', $nama)[0];

$doge = explode('<div class="col-9 no-space">Current Bits Value <div class="text-warning"><b>', $dashboard)[1];
$doge = explode('</b></div></div>', $doge)[0];

echo "\t".$nama."\n";
echo "\t".$doge."\n\n";

while (true){

	$dashboard = dashboard($ua,$cook);

	$token = explode("var token = '", $dashboard)[1];
	$token = explode("';", $token)[0];


	$claim = claim($ua,$cook,$token);
	$msg = explode('{"number":', $claim)[1];
	$msg = explode(',"reward":', $msg)[0];

	$get = explode('{"number":'.$msg.',"reward":', $claim)[1];
	$get = explode(',"message"', $get)[0];

	echo "\n Number ".$msg." Get +".$get."\n";

	sleep(4);
}




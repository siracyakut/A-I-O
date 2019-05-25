// Base: NexoR - Edit: flareoNNN

<?php
	header('Content-Type: text/html; charset=utf-8');
	
	$urltest = $_GET['link'];
	
	if(strpos($urltest, 'v=') == false)
	{
		echo "ERR";
		exit;
	}
	
	parse_str(parse_url($urltest, PHP_URL_QUERY), $vid_id);
	
	$url = "https://api.download-lagu-mp3.com/@api/json/mp3/" . $vid_id['v'];
	$veri = file_get_contents($url);
	
	$xx1 = preg_replace("/\\\\u([0-9abcdef]{4})/", "&#x$1;", $veri);
	$xx2 = str_replace("\\", "", $xx1);
	$xx3 = str_replace("//", "", $xx2);
	
	$coz = json_decode($xx3);
	
	if(strpos($coz->{'vidTitle'}, 'unknown_') !== false)
	{
		echo "ERR";
		exit;
	}
	
	$str = html_entity_decode($coz->{'vidTitle'} . "*");
	
	$fix1 = mb_str_replace($str, "ı", "0x01");
	$fix2 = mb_str_replace($fix1, "ğ", "0x02");
	$fix3 = mb_str_replace($fix2, "Ğ", "0x03");
	$fix4 = mb_str_replace($fix3, "ü", "0x04");
	$fix5 = mb_str_replace($fix4, "Ü", "0x05");
	$fix6 = mb_str_replace($fix5, "ş", "0x06");
	$fix7 = mb_str_replace($fix6, "Ş", "0x07");
	$fix8 = mb_str_replace($fix7, "İ", "0x08");
	$fix9 = mb_str_replace($fix8, "ö", "0x09");
	$fix10 = mb_str_replace($fix9, "Ö", "0x10");
	$fix11 = mb_str_replace($fix10, "ç", "0x11");
	$fix12 = mb_str_replace($fix11, "Ç", "0x12");
	
	echo $fix12;
	$oku = json_decode($xx3, true);
	$isgd = "https://is.gd/create.php?format=simple&url=http://". $oku['vidInfo']['2']['dloadUrl'];
	echo file_get_contents($isgd);
	
	function mb_str_replace($haystack, $search,$replace, $offset=0,$encoding='auto')
	{
		$len_sch=mb_strlen($search,$encoding);
		$len_rep=mb_strlen($replace,$encoding);
		
		while (($offset=mb_strpos($haystack,$search,$offset,$encoding))!==false)
		{
			$haystack=mb_substr($haystack,0,$offset,$encoding)
				.$replace
				.mb_substr($haystack,$offset+$len_sch,1000,$encoding);
			$offset=$offset+$len_rep;
			if ($offset>mb_strlen($haystack,$encoding))break;
		}
		return $haystack;
	}
?>

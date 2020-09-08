<?php

const IP_SERVICE = 'https://ipinfo.io/';

function dbi()
{
    $dbi = new MysqliDb ('localhost', 'root', '', 'blog');
    
    return $dbi;
}

function mostReads()
{
    $t = &get_instance();
    $dbi = dbi();
    $genelArray = array();
    $lang = $t->session->userdata("lang");
                
    $dbi->where("catId", "php");
    $mostReadsPhp = $dbi->get("pPost", null, "MAX(nofRead), postTitle, postTitleEn, catId, file, postImage");
    foreach($mostReadsPhp as $mPhp)
    {
        if($lang == "en") $pTitleP = $mPhp["postTitleEn"];
        else $pTitleP = $mPhp["postTitle"];
        
        $genelArray[] = array("postTitle" => $pTitleP, "catId" => $mPhp["catId"], "file" => $mPhp["file"], "postImage" => $mPhp["postImage"]);
    }

    $dbi->where("catId", "javascript");
    $mostReadsJv = $dbi->get("pPost", null, "MAX(nofRead), postTitle, postTitleEn, catId, file, postImage");
    foreach($mostReadsJv as $mJv)
    {
        if($lang == "en") $pTitleJv = $mJv["postTitleEn"];
        else $pTitleJv = $mJv["postTitle"];
        
        $genelArray[] = array("postTitle" => $pTitleJv, "catId" => $mJv["catId"], "file" => $mJv["file"], "postImage" => $mJv["postImage"]);
    }

    $dbi->where("catId", "jquery");
    $mostReadsJq = $dbi->get("pPost", null, "MAX(nofRead), postTitle, postTitleEn, catId, file, postImage");
    foreach($mostReadsJq as $mJq)
    {
        if($lang == "en") $pTitleJq = $mJq["postTitleEn"];
        else $pTitleJq = $mJq["postTitle"];
        
        $genelArray[] = array("postTitle" => $pTitleJq, "catId" => $mJq["catId"], "file" => $mJq["file"], "postImage" => $mJq["postImage"]);
    }                    

    $dbi->where("catId", "css");
    $mostReadsCss = $dbi->get("pPost", null, "MAX(nofRead), postTitle, postTitleEn, catId, file, postImage");
    foreach($mostReadsCss as $mCss)
    {
        if($lang == "en") $pTitleC = $mCss["postTitleEn"];
        else $pTitleC = $mCss["postTitle"];
        
        $genelArray[] = array("postTitle" => $pTitleC, "catId" => $mCss["catId"], "file" => $mCss["file"], "postImage" => $mCss["postImage"]);
    }
    
    return $genelArray;
}    

function postTime($date)
{
    $gecmis = strtotime($date);

    $bugun = strtotime(date("Y-m-d H:i:s"));

    $fark = $bugun - $gecmis;

    $dakika = $fark / 60;
    $saniye_farki = floor($fark - (floor($dakika) * 60));

    $saat = $dakika / 60;
    $dakika_farki = floor($dakika - (floor($saat) * 60));

    $gun = $saat / 24;
    $saat_farki = floor($saat - (floor($gun) * 24));

    $yil = floor($gun/365);
    $gun_farki = floor($gun - (floor($yil) * 365));
    
    if($yil != "0") return $yil ." ". _YEAR_AGO;
    else if($gun_farki != "0") return $gun_farki ." ". _DAYS_AGO;
    else if($saat_farki != "0") return $saat_farki ." ". _HOURS_AGO;
    else if($dakika_farki != "0") return $dakika_farki ." ". _MINUTE_AGO;
    else return $saniye_farki ." ". _SECONDS_AGO;
}

function dateFormat($date)
{
    $format = date_create($date);
    return date_format($format,"F j, Y");
}

function phpCount()
{
    $dbi = dbi();
    $dbi->where("catId", "php");
    $count = $dbi->getValue("pPost", "COUNT(*)");
    return $count;
}

function javascriptCount()
{
    $dbi = dbi();
    $dbi->where("catId", "javascript");
    $count = $dbi->getValue("pPost", "COUNT(*)");
    return $count;
}

function jqueryCount()
{
    $dbi = dbi();
    $dbi->where("catId", "jquery");
    $count = $dbi->getValue("pPost", "COUNT(*)");
    return $count;
}

function cssCount()
{
    $dbi = dbi();
    $dbi->where("catId", "css");
    $count = $dbi->getValue("pPost", "COUNT(*)");
    return $count;
}


function convertToSeo($title)
{
    $turkce = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", " ", "?", "*", "_", "|", "=");
    $convert = array("c","c","g", "g", "u", "u", "o", "o", "i","i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"); 
        
    return $seo = strtolower(str_replace($turkce, $convert, $title));
}

function userName($userId)
{
    $dbi = dbi();
    
    $dbi->where("id", $userId);
    $userName = $dbi->getValue("users", "user_name");
    
    if(!empty($userName)) return $userName;
    else return NULL;
}

function get_active_user()
{
    $t = &get_instance();
    
    $user = $t->session->userdata("user");
    
    if($user)
    {
        return $user;
    }
    else
    {
        return false;
    }
    
}

function menuler()
{
    $t = &get_instance();
    
    $t->load->model("menu_setting_model");
    
    $menuler = $t->menu_setting_model->get_all(array("isActive" => "1"));
    
    return $menuler;
}

function sub_menuler()
{
    $t = &get_instance();
    
    $t->load->model("sub_menu_model");
    
    $sub_menuler = $t->sub_menu_model->get_all(array());
    
    return $sub_menuler;
}

function languages()
{
    $t = &get_instance();
    
    $t->load->model("language_model");
    
    $languages = $t->language_model->get_all(array());
    
    return $languages;
}

function messages()
{
    $t = &get_instance();
    
    $user = $t->session->userdata("user");
    
    $t->load->model("messages_model");
    
    $messages = $t->messages_model->get_all(array("alici_id" => $user->id));
    
    return $messages;
}

function navbar_messages()
{
    $t = &get_instance();
    
    $user = $t->session->userdata("user");
    
    $t->load->model("messages_model");
    
    $messages = $t->messages_model->get_all(array("alici_id" => $user->id, "okunduMu" => "0"));
    
    return $messages;
}

function translate($kelime)
{
    
    $t = &get_instance();
    
    $t->load->model("language_model");
    
    $dil = $t->session->userdata("lang");
    
    if($dil == "tr")
    {
        $lang = $t->language_model->get(array("degisken" => $kelime));
        $result = $lang->turkce_adi;
    }
    else
    {
        $lang = $t->language_model->get(array("degisken" => $kelime));
        $result = $lang->ingilizce_adi;
    }
    
    return $result;
    
}


function getIP(){
    
	if(getenv("HTTP_CLIENT_IP")) 
    {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} 
    elseif(getenv("HTTP_X_FORWARDED_FOR")) 
    {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} 
    else 
    {
 	    $ip = getenv("REMOTE_ADDR");
 	}
    
	return $ip;
}

function os() 
{
    $tespit=$_SERVER['HTTP_USER_AGENT'];
    if(stristr($tespit,"Windows 95")) { $os="Windows 95"; }
    elseif(stristr($tespit,"Windows 98")) { $os="Windows 98"; }
    elseif(stristr($tespit,"Windows NT 5.0")) { $os="Windows 2000"; }
    elseif(stristr($tespit,"Windows NT 5.1")) { $os="Windows XP"; }
    elseif(stristr($tespit,"Windows NT 6.0")) { $os="Windows Vista"; }
    elseif(stristr($tespit,"Windows NT 6.1")) { $os="Windows 7"; }
    elseif(stristr($tespit,"Windows NT 6.2")) { $os="Windows 8"; }
    elseif(stristr($tespit,"Mac")) { $os="Mac"; }
    elseif(stristr($tespit,"Linux")) { $os="Linux"; }
    else {$os="Bilinmiyor ?";}
    return $os;
}


function tarayici() 
{
    $tespit2=$_SERVER['HTTP_USER_AGENT'];
    if(stristr($tespit2,"MSIE")) { $tarayici="Internet Explorer"; }
    elseif(stristr($tespit2,"Firefox")) { $tarayici="Mozilla Firefox"; }
    elseif(stristr($tespit2,"YaBrowser")) { $tarayici="Yandex Browser"; }
    elseif(stristr($tespit2,"Chrome")) { $tarayici="Google Chrome"; }
    elseif(stristr($tespit2,"Safari")) { $tarayici="Safari"; }
    elseif(stristr($tespit2,"Opera")) { $tarayici="Opera"; }
    else {$tarayici="Bilinmiyor ?";}
    return $tarayici;
}

function location($ipAddress)
{
    

    $data     = file_get_contents(IP_SERVICE . $ipAddress);
    $location = json_decode($data, true);
    
    return $location;
    
    //callback data
    /*
    Array
    (
        [ip] => 88.238.127.23
        [city] => Istanbul
        [region] => Istanbul
        [country] => TR
        [loc] => 41.0040,28.9788
        [hostname] => 88.238.127.23.dynamic.ttnet.com.tr
        [postal] => 34122
        [org] => AS9121 Turk Telekomunikasyon Anonim Sirketi
    )
    */
}

function objectToArray($d) 
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}

//generate a username from Full name
function generate_username($string_name="", $rand_no = 9999){
	$username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
	$username_parts = array_slice($username_parts, 0, 2); //return only first two arry part
	
	$part1 = (!empty($username_parts[0]))?substr($username_parts[0], 0,8):""; //cut first name to 8 letters
	$part2 = (!empty($username_parts[1]))?substr($username_parts[1], 0,5):""; //cut second name to 5 letters
	$part3 = ($rand_no)?rand(0, $rand_no):"";
		
	$username = $part1. str_shuffle($part2). $part3; //str_shuffle to randomly shuffle all characters 
	return $username;
    
    //usage
    //echo generate_username("Mike Tyson", 10);

}




?>
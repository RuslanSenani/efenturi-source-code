<?php
function get_token()
{
	return md5(md5(time()));
}

function create_id()
{
	return time();
}
//

function get_latin($string)
{
	$converter = array(
		'а' => 'a',   'б' => 'b',   'в' => 'v',
		'г' => 'g',   'д' => 'd',   'е' => 'e',
		'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
		'и' => 'i',   'й' => 'y',   'к' => 'k',
		'л' => 'l',   'м' => 'm',   'н' => 'n',
		'о' => 'o',   'п' => 'p',   'р' => 'r',
		'с' => 's',   'т' => 't',   'у' => 'u',
		'ф' => 'f',   'х' => 'h',   'ц' => 'c',
		'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
		'ь' => '',  'ы' => 'y',   'ъ' => '',
		'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

		'А' => 'A',   'Б' => 'B',   'В' => 'V',
		'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
		'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
		'И' => 'I',   'Й' => 'Y',   'К' => 'K',
		'Л' => 'L',   'М' => 'M',   'Н' => 'N',
		'О' => 'O',   'П' => 'P',   'Р' => 'R',
		'С' => 'S',   'Т' => 'T',   'У' => 'U',
		'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
		'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
		'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
		'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
	);
	return strtr($string, $converter);
}


function set_link($string)
{
	$s = str_replace("Ə", "e", $string);
	$s = str_replace("ə", "e", $s);
	$s = str_replace("İ", "i", $s);
	$s = str_replace("Ğ", "q", $s);
	$s = str_replace("Ö", "o", $s);
	$s = str_replace("ö", "o", $s);
	$s = str_replace("ğ", "q", $s);
	$s = str_replace("Ş", "s", $s);
	$s = str_replace("ş", "s", $s);
	$s = str_replace("Ç", "c", $s);
	$s = str_replace("ç", "c", $s);
	$s = str_replace("Ü", "u", $s);
	$s = str_replace("ü", "u", $s);
	$s = str_replace("ı", "i", $s);
	$s = str_replace('"', '', $s);
	$s = str_replace("'", '', $s);
	$s = str_replace(",", '', $s);
	$s = str_replace("?", '', $s);
	$s = str_replace("&", 'and', $s);
	$s = get_latin($s);
	$s = mb_strtolower($s);
	return str_replace(" ", "-", $s);
}


function set_text($string)
{
	$s = str_replace("Ə", "E", $string);
	$s = str_replace("ə", "e", $s);
	$s = str_replace("Ğ", "Q", $s);
	$s = str_replace("Ö", "O", $s);
	$s = str_replace("ö", "o", $s);
	$s = str_replace("ğ", "g", $s);
	$s = str_replace("Ş", "S", $s);
	$s = str_replace("ş", "s", $s);
	$s = str_replace("Ç", "C", $s);
	$s = str_replace("ç", "c", $s);
	$s = str_replace("Ü", "U", $s);
	$s = str_replace("ü", "u", $s);
	$s = str_replace("ı", "i", $s);
	$s = str_replace('"', '', $s);
	$s = str_replace("'", '', $s);
	$s = get_latin($s);
	return $s;
}


function get_status($string)
{
	return ($string == 'true' ? 'active' : 'deactive');
}


function get_json($string)
{
	if (!empty($string)) {
		return json_decode($string);
	} else {
		return json_decode('{"link":""}');
	}
}


function get_lang($l = '')
{
	if (isset($_COOKIE['lang'])) {
		if ($l == 'url_tag') {
			return $_COOKIE['url_tag'];
		} else {
			return $_COOKIE['lang'];
		}
	} else {

		if ($l == 'url_tag') {
			return 'AZ';
		} else {
			return 29;
		}
	}
}


function get_month($month)
{
	return explode(',', $month);
}


function get_trim($string)
{
	return str_replace(' ', '', $string);
}


function get_date($date, $months)
{

	$date = explode('-', $date);
	return $date[2] . ' ' . get_month($months)[ltrim($date[1], '0') - 1] . ' ' . $date[0];
}

/*image */
function get_image($string)
{
	$url = '';
	if (!empty($string)) {
		$json = get_json($string);
		if (isset($json->webp) and $json->webp == true) {
			$url = 'uploads/webp/' . $json->webp_url;
		} else {
			$url = 'uploads/images/' . $json->link;
		}
	} else {
		$url = 'assets/img/404.png';
	}
	return base_url() . $url;
}


function get_thumb($string)
{
	$url = '';
	if (!empty($string)) {

		$json = get_json($string);
		if (isset($json->thumb) and $json->thumb == true) {
			$url = 'uploads/thumb/' . $json->webp_url;
		} else {
			$url = 'uploads/images/' . $json->link;
		}
	} else {
		$url = 'assets/img/404.png';
	}
	return base_url() . $url;
}


function get_img($string)
{
	return base_url() . '/assets/img/' . $string;
}


function get_script($string)
{
	return base_url() . '/assets/' . $string . '?ver=' . time();
}


function get_request_url($string = '')
{
	$uri = $_SERVER['REQUEST_URI'];
	if ($uri == '/') {
		return base_url() . $string;
	} else {
		return base_url() . ltrim($uri, '/') . '/' . $string;
	}
}


function get_base_url($string)
{
	return base_url() . $string;
}

/*social share  */
function get_facebook($url = '')
{
	$url = get_request_url($url);
	return 'https://www.facebook.com/sharer/sharer.php?u=' . $url . '&hashtag=%23homedecor.az" target="_blank"';
}


function get_linkedin($url = '', $title)
{
	$url = get_request_url($url);
	return 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title;
}


function get_twitter($url = '', $title)
{
	$url = get_request_url($url);
	return 'https://twitter.com/share?text=' . $title . ';url=' . $url;
}

/*password generator */
function get_password($string)
{
	return md5($string);
}
/*new functions */



function check_event_send_request($data)
{
	$ar = array('attendee', 'participant_booth', 'speaker_pass', 'sponsorship_partner', 'media_partner', 'entry_ticket');
	return in_array($data, $ar);
}

function check_event_entry_request($data)
{
	$ar = array('free', 'paid');
	return in_array($data, $ar);
}

function check_event_status_request($data)
{
	$ar = array('active', 'cancelled', 'postponed');
	return in_array($data, $ar);
}

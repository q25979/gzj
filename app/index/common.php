<?php

/**
 * base64 加密 需要加密的字符串不能出现 => | 字符不然会出错
 * @param array $data
 * @return string 
 */
function addBase64($data) {
	$string = "";
	$base64key = config()['base64key'];

	// 数据转字符串
	$index = 0;
	foreach ($data as $k => $v) {
		$string .= $k . '=>' .$v;
		$index++;
		if ($index < count($data)) {
			$string .= '|';
		}
	}
	$base64 = base64_encode($string);
	$buildstr = $base64key[0].$base64key[1].$base64key[2];

	for ($i=0; $i<strlen($base64); $i++) {
		if ($i < 3) {
			$buildstr .= $base64[$i];
		}
		if ($i == 3) {
			for ($j=3; $j<8; $j++) {
				$buildstr .= $base64key[$j];
			}
		}
		if ($i >= 3 && $i < strlen($base64)) {
			$buildstr .= $base64[$i];
		}
	}
	for ($i=8; $i<16; $i++) {
		$buildstr .= $base64key[$i];
	}

	$result = [
		'buildstr' => $buildstr,
		'length' => strlen($base64),
	];
	return $result;
}

/**
 * 解密base64
 * @param array $data
 * @return array 
 */
function removeBase64($data) {
	$base64key = config()['base64key'];
	$buildstr = '';

	for ($i=0; $i<strlen($data['buildstr']); $i++) {
		if ($i >= 3 && $i < 6) {
			$buildstr .= $data['buildstr'][$i];
		}
		if ($i > 10 && $i < $data['length']+8) {
			$buildstr .= $data['buildstr'][$i];
		}
	}
	$removeBase64 = base64_decode($buildstr);
	$arrindex = explode("|", $removeBase64);

	// 字符串转数组
	foreach ($arrindex as $k => $v) {
		$arrkey[$k] = explode("=>", $v);
	}
	foreach ($arrkey as $k => $v) {
		$result[$k][$v[0]] = $v[1];
	}
	foreach ($result as $k => $v) {
		foreach ($v as $key => $value) {
			$newresult[$key] = $value;
		}
	}

	return $newresult;
}

/**
 * 未登录账号返回数据
 * @return array
 */
function noLogin() {
	return [
		'code'	=> -1,
		'msg'	=> '您未登录,请先登录账号!',
		'error_msg'	=> '账号cookie未保存'
	];
}

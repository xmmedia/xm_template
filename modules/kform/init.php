<?php


function get($key, array $arr, $default = null) {
	if (array_key_exists($key, $arr)) return $arr[$key];
	return $default;
}
<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('kryptex_storage_get')) {
	function kryptex_storage_get($var_name, $default='') {
		global $KRYPTEX_STORAGE;
		return isset($KRYPTEX_STORAGE[$var_name]) ? $KRYPTEX_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('kryptex_storage_set')) {
	function kryptex_storage_set($var_name, $value) {
		global $KRYPTEX_STORAGE;
		$KRYPTEX_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('kryptex_storage_empty')) {
	function kryptex_storage_empty($var_name, $key='', $key2='') {
		global $KRYPTEX_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($KRYPTEX_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($KRYPTEX_STORAGE[$var_name][$key]);
		else
			return empty($KRYPTEX_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('kryptex_storage_isset')) {
	function kryptex_storage_isset($var_name, $key='', $key2='') {
		global $KRYPTEX_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($KRYPTEX_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($KRYPTEX_STORAGE[$var_name][$key]);
		else
			return isset($KRYPTEX_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('kryptex_storage_inc')) {
	function kryptex_storage_inc($var_name, $value=1) {
		global $KRYPTEX_STORAGE;
		if (empty($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = 0;
		$KRYPTEX_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('kryptex_storage_concat')) {
	function kryptex_storage_concat($var_name, $value) {
		global $KRYPTEX_STORAGE;
		if (empty($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = '';
		$KRYPTEX_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('kryptex_storage_get_array')) {
	function kryptex_storage_get_array($var_name, $key, $key2='', $default='') {
		global $KRYPTEX_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($KRYPTEX_STORAGE[$var_name][$key]) ? $KRYPTEX_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($KRYPTEX_STORAGE[$var_name][$key][$key2]) ? $KRYPTEX_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('kryptex_storage_set_array')) {
	function kryptex_storage_set_array($var_name, $key, $value) {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if ($key==='')
			$KRYPTEX_STORAGE[$var_name][] = $value;
		else
			$KRYPTEX_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('kryptex_storage_set_array2')) {
	function kryptex_storage_set_array2($var_name, $key, $key2, $value) {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if (!isset($KRYPTEX_STORAGE[$var_name][$key])) $KRYPTEX_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$KRYPTEX_STORAGE[$var_name][$key][] = $value;
		else
			$KRYPTEX_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('kryptex_storage_merge_array')) {
	function kryptex_storage_merge_array($var_name, $key, $value) {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if ($key==='')
			$KRYPTEX_STORAGE[$var_name] = array_merge($KRYPTEX_STORAGE[$var_name], $value);
		else
			$KRYPTEX_STORAGE[$var_name][$key] = array_merge($KRYPTEX_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('kryptex_storage_set_array_after')) {
	function kryptex_storage_set_array_after($var_name, $after, $key, $value='') {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if (is_array($key))
			kryptex_array_insert_after($KRYPTEX_STORAGE[$var_name], $after, $key);
		else
			kryptex_array_insert_after($KRYPTEX_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('kryptex_storage_set_array_before')) {
	function kryptex_storage_set_array_before($var_name, $before, $key, $value='') {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if (is_array($key))
			kryptex_array_insert_before($KRYPTEX_STORAGE[$var_name], $before, $key);
		else
			kryptex_array_insert_before($KRYPTEX_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('kryptex_storage_push_array')) {
	function kryptex_storage_push_array($var_name, $key, $value) {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($KRYPTEX_STORAGE[$var_name], $value);
		else {
			if (!isset($KRYPTEX_STORAGE[$var_name][$key])) $KRYPTEX_STORAGE[$var_name][$key] = array();
			array_push($KRYPTEX_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('kryptex_storage_pop_array')) {
	function kryptex_storage_pop_array($var_name, $key='', $defa='') {
		global $KRYPTEX_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($KRYPTEX_STORAGE[$var_name]) && is_array($KRYPTEX_STORAGE[$var_name]) && count($KRYPTEX_STORAGE[$var_name]) > 0)
				$rez = array_pop($KRYPTEX_STORAGE[$var_name]);
		} else {
			if (isset($KRYPTEX_STORAGE[$var_name][$key]) && is_array($KRYPTEX_STORAGE[$var_name][$key]) && count($KRYPTEX_STORAGE[$var_name][$key]) > 0)
				$rez = array_pop($KRYPTEX_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('kryptex_storage_inc_array')) {
	function kryptex_storage_inc_array($var_name, $key, $value=1) {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if (empty($KRYPTEX_STORAGE[$var_name][$key])) $KRYPTEX_STORAGE[$var_name][$key] = 0;
		$KRYPTEX_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('kryptex_storage_concat_array')) {
	function kryptex_storage_concat_array($var_name, $key, $value) {
		global $KRYPTEX_STORAGE;
		if (!isset($KRYPTEX_STORAGE[$var_name])) $KRYPTEX_STORAGE[$var_name] = array();
		if (empty($KRYPTEX_STORAGE[$var_name][$key])) $KRYPTEX_STORAGE[$var_name][$key] = '';
		$KRYPTEX_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('kryptex_storage_call_obj_method')) {
	function kryptex_storage_call_obj_method($var_name, $method, $param=null) {
		global $KRYPTEX_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($KRYPTEX_STORAGE[$var_name]) ? $KRYPTEX_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($KRYPTEX_STORAGE[$var_name]) ? $KRYPTEX_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('kryptex_storage_get_obj_property')) {
	function kryptex_storage_get_obj_property($var_name, $prop, $default='') {
		global $KRYPTEX_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($KRYPTEX_STORAGE[$var_name]->$prop) ? $KRYPTEX_STORAGE[$var_name]->$prop : $default;
	}
}
?>
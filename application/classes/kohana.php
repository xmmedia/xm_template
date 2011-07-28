<?php defined('SYSPATH') or die ('No direct script access.');

class Kohana extends Kohana_Core {
	/**
	 * @var  array   Include paths that are used to find files
	 * Adds CL4_PATH to the list of default paths to use when looking for files
	 * Used when finding the exception handler
	 */
	protected static $_paths = array(APPPATH, CL4_PATH, SYSPATH);
}
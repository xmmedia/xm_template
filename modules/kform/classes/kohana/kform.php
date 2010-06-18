<?php

class Kohana_KForm {

	public $model;

	public $is_valid = true;
	
	protected $progress_id;
	
	protected $edit_mode;

	public function __construct($file = null, $auto_init = TRUE) {
		if ($file != null) {
			$this->model = require Kohana::find_file('forms', $file);
		}
		if ($auto_init) {
			$this->init();
		}
		$this->config = Kohana::config('kform');
	}

	protected function init() {
		foreach ($this->model['fields'] as $key => $field) {
			if (array_key_exists('data_source', $field)) {
				$val_field = $field['data_source']['val_field'];
				$text_field = $field['data_source']['text_field'];
				$params = array_key_exists('params', $field['data_source']) ? $field['data_source']['params'] : null;
				$list = call_user_func_array($field['data_source']['callback'], $params);

				if ( ! array_key_exists('items', $field)) {
					$field['items'] = array();
				}

				if ( ! array_key_exists('result', $field['data_source']) || $field['data_source']['result'] == 'array') {
					foreach ($list as $item) {
						$field['items'] []= array('value' => $item[$val_field], 'text' => $item[$text_field]);
					}
				} else if ($field['data_source']['result'] == 'object') {
					foreach ($list as $item) {
						$field['items'] []= array('value' => $item->$val_field, 'text' => $item->$text_field);
					}
				} else {
					throw new Exception('unknown result type: '.$field['data_source']['result']);
				}
			}
		}
	}

	public function pre_populate($src) {
		$this->edit_mode = true;
		$progress_id = null;
		foreach ($src as $prop => $val) {
			$found = false;
			foreach ($this->model['fields'] as &$field) {
				if (array_key_exists('name', $field) &&
				$field['name'] == $prop) {
					$found = true;					
					$field['value'] = $val;
				}
			}
			if ( ! $found) {
				if ($progress_id == null) {
					$progress_id = $this->create_progress_id();
				}
				$_SESSION[$this->config['session_key']]['progress'][$progress_id][$prop] = $val;
			}
		}
	}

	public function populate($src) {
		foreach ($this->model['fields'] as &$field) {
			if (array_key_exists('name', $field) &&
			array_key_exists($field['name'], $src)) {
				if ($src[$field['name']] === "" && array_key_exists('on_empty', $field)) {
					$field['value'] = $field['on_empty'];
				} else {
					$field['value'] = $src[$field['name']];
				}
			}
		}
		if (array_key_exists($this->config['progress_key'], $src)) {
			$this->progress_id = $src[$this->config['progress_key']];
			$this->edit_mode = true;
		}
		return $this->validate();
	}

	protected function create_progress_id() {
		$sess_key = $this->config['session_key'];
		if ( ! array_key_exists($sess_key, $_SESSION)) {
			$_SESSION[$sess_key] = array();
		}
		if ( ! array_key_exists('progress', $_SESSION[$sess_key])) {
			$_SESSION[$sess_key]['progress'] = array();
		}

		if ( ! array_key_exists('progress_counter', $_SESSION[$sess_key])) {
			$_SESSION[$sess_key]['progress_counter'] = 0;
		}
		if ($_SESSION[$sess_key]['progress_counter'] == 32767) {
			$_SESSION[$sess_key]['progress_counter'] = 0;
		}

		$progress_id = sha1($_SESSION[$sess_key]['progress_counter']++);
		$_SESSION[$sess_key]['progress'][$progress_id] = array();

		$this->model['fields'] []= array(
			'name' => $this->config['progress_key'],
			'type' => 'hidden',
			'value' => $progress_id
		);

		return $progress_id;
	}

	public function validate() {
		foreach ($this->model['fields'] as &$field) {
			if (array_key_exists('validation', $field)) {
				if (get('hide_on_edit', $field) === true && $this->edit_mode) 
					continue;
				foreach ($field['validation'] as $validator) {
					if (array_key_exists('custom', $validator))	{
						$params = $field['value'];
						if (array_key_exists('params', $validator['custom'])) {
							$params = array($params);
							foreach ($validator['custom']['params'] as $p) $params []= $p;
						}
						if (!call_user_func($validator['custom']['callback'], $params)) {
							try  {
								$this->is_valid = false;
								$field['errors'][] = $this->get_error($validator);
							} catch (Exception $ex) {
								throw new Exception('error message not defined for field '.$field['name']);
							}
						}
					} else {
						$keys = array_keys($validator);
						$type = $keys[0];
						$params = $field['value'];
						if (array_key_exists('params', $validator)) {
							$params = array($params);
							foreach ($validator['params'] as $p) $params []= $p;
						}
						if (!call_user_func_array(array('Validate', $type), $params)) {
							try  {
								$this->is_valid = false;
								$field['errors'][] = $this->get_error($validator);
							} catch (Exception $ex) {
								throw new Exception('error message not defined for field '.$field['name']);
							}
						}
					}
				}
			}
		}
		return $this->is_valid;
	}

	public function result() {
		$result_type = $this->model['result_type'];
		if ($result_type == 'array') {
			$rval = array();
			foreach ($this->model['fields'] as $field) {
				if (array_key_exists('name', $field) && array_key_exists('value', $field)) {
					$rval[$field['name']] = $field['value'];
				}
			}
			if ($this->progress_id != null) {
				foreach ($_SESSION[$this->config['session_key']]['progress'][$this->progress_id] as $k => $v) {
					$rval[$k] =$v;
				}
			}
			return $rval;
		} else {
			$rval = new $result_type;
			foreach ($this->model['fields'] as $field) {
				if (array_key_exists('name', $field) && array_key_exists('value', $field)) {
					$prop = $field['name'];
					$rval->$prop = $field['value'];
				}
			}
			if ($this->progress_id != null) {
				foreach ($_SESSION[$this->config['session_key']]['progress'][$this->progress_id] as $k => $v) {
					$rval->$k =$v;
				}
			}
			return $rval;
		}
	}

	protected function get_error(array $validator) {
		if (array_key_exists('error_key', $validator)) {
			return I18n::get($validator['error_key']);
		} else if (array_key_exists('error', $validator)) {
			return $validator['error'];
		} else {
			$key_set = array_keys($validator);
			$key = $key_set[0];
			if ($key == 'custom') {
				$key = $validator['custom']['callback'];
				$key = $key[count($key) - 1];
			}
			$key = str_replace(':key', $key, $this->config['default_error_key']);
			$err = I18n::get($key);
			if ($err != $key) {
				return $err;
			}
		}
		throw new Exception('error message not defined');
	}

	protected function load_defaults() {
		if ( ! array_key_exists('view', $this->model)) {
			$this->model['view'] = 'kform/layout';
		}
		if ( ! array_key_exists('attributes', $this->model)) {
			$this->model['attributes'] = array();
		}
		if ( ! array_key_exists('method', $this->model['attributes'])) {
			$this->model['attributes']['method'] = 'post';
		}
		if ( ! array_key_exists('action', $this->model['attributes'])) {
			$this->model['attributes']['action'] = '';
		}

		if ( ! array_key_exists('autoadd_asterisk', $this->model)) {
			$this->model['autoadd_asterisk'] = true;
		}
		$delete_keys = array();
		foreach ($this->model['fields'] as $k => &$field) {
			if (get('hide_on_edit', $field) == true && $this->edit_mode) {
				$delete_keys []= $k;
				continue;
			}
			if (array_key_exists('label_key', $field)) {
				if (is_array($field['label_key'])) {
					$field['label'] = I18n::get($field['label_key'][$this->edit_mode ? 'on_edit' : 'on_create']);
				} else {
					$field['label'] = I18n::get($field['label_key']);
				}
			}
			
			if (array_key_exists('label', $field) && is_array($field['label'])) {
				$field['label'] = $field['label'][$this->edit_mode ? 'on_edit' : 'on_create'];
			}
			
			if (array_key_exists('value_key', $field)) {
				if (is_array($field['value_key'])) {
					$field['value'] = I18n::get($field['value_key'][$this->edit_mode ? 'on_edit' : 'on_create']);
				} else {
					$field['value'] = I18n::get($field['value_key']);
				}
			}
			
			if (array_key_exists('value', $field) && is_array($field['value'])) {
				$field['value'] = $field['value'][$this->edit_mode ? 'on_edit' : 'on_create'];
			}

			if (array_key_exists('validation', $field)) {
				foreach ($field['validation'] as $validator) {
					if (array_key_exists('not_empty', $validator)
					&& $this->model['autoadd_asterisk'] === true) {
						$field['not_empty'] = true;
					}
				}
			}

			if ( ! array_key_exists('view', $field)) {
				$field['view'] = 'kform/'.$field['type'];
			}
			$v = new View($field['view']);
			$field['view'] = $v;
			$v->model = $field;

		}
		foreach ($delete_keys as $k => &$v) {
			unset($this->model['fields'][$v]);
		}
		//print_r($this->model); die();
	}

	public function render() {
		$this->load_defaults();
		$view = new View($this->model['view']);
		$view->model = $this->model;
		return $view->render();
	}

	public function __toString() {
		return $this->render();
	}

}

<?php

namespace streaky\form;

class validateException extends \Exception {}

class validateInfo extends validateException {}
class validateWarn extends validateException {}
class validateError extends validateException {}

class validate {
	
	public static function getValidationItems($callback) {
		// XXX: This is probably cacheable, maybe need it, maybe don't...
		$reflection = new \ReflectionClass($callback);
		$methods = $reflection->getMethods(\ReflectionMethod::IS_STATIC);
		
		$items = array();
		foreach($methods as $method) {
			if($method->isPublic() == true) {
				$items[] = $method->name;
			}
		}
		return $items;
	}
	
	public static function validateForm(\streaky\form\element\form &$form, $values) {
		$class = $form->validate;
		$items = self::getValidationItems($class);
		
		$valid = true;
		
		foreach($values as $key => $value) {
			
			// get a reference to the form item
			$item = $form->getItemByName($key);
			
			if(in_array($key, $items) || $item->required == true) {
				
				$extra = false;
				
				if(is_array($item->extra) && count($item->extra) > 0) {
					$extra = array();
					foreach($item->extra as $name) {
						$extra[$name] = $values[$name];
					}
				}
				
				$response = self::validateItem($form, $key, $value, $extra);
				$item->value = $response->value;
				
				if($response->message != "") {
					$item->help = $response->message;
				}
				switch($response->error) {
					case validateResponse::ok:
						$item->classes_outer[] = "success";
					break;
					case validateResponse::info:
						$item->classes_outer[] = "info";
					break;
					case validateResponse::warn:
						$item->classes_outer[] = "warning";
					break;
					case validateResponse::error:
						$item->classes_outer[] = "error";
						$valid = false;
					break;
					default:
						throw new validateException("Unknown status type");
				}
			}
		}
		
		return $valid;
	}
	
	/**
	 * @param \streaky\form\element\form $form
	 * @param string $name
	 * @param string $value
	 * @param boolean|array $extra
	 * @return \streaky\form\validateResponse
	 */
	public static function validateItem(\streaky\form\element\form &$form, $name, $value, $extra = false) {
		$class = $form->validate;
		$response = new validateResponse();
		
		$item = $form->getItemByName($name);
		if($item->required == true && trim($value) == "") {
			$response->error = validateResponse::error;
			$response->message = "This item is required";
			return $response;
		}
		
		$items = self::getValidationItems($class);
		if(!in_array($name, $items)) {
			// probably just a required field with no further validation
			$response->value = $value;
			$response->error = validateResponse::ok;
			return $response;
		}
		
		try {
			$class::$name($value, $extra);
		} catch(validateError $ex) {
			$response->error = validateResponse::error;
			$response->message = $ex->getMessage();
		} catch(validateWarn $ex) {
			$response->error = validateResponse::warn;
			$response->message = $ex->getMessage();
		} catch(validateInfo $ex) {
			$response->error = validateResponse::info;
			$response->message = $ex->getMessage();
		}
		$response->value = $value;
		return $response;
	}
}

class validateResponse {
	
	const ok = 0;
	const info = 1;
	const warn = 2;
	const error = 3;
	
	public $value = "";
	public $message = "";
	public $error = 0;
}

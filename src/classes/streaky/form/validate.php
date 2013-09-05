<?php

namespace streaky\form;

class validateException extends \Exception {}

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
					$item->message = $response;
					//$item->help = $response->message;
				}
				switch($response->error) {
					case validate\response::ok:
						$item->classes_outer[] = "success";
					break;
					case validate\response::info:
						$item->classes_outer[] = "info";
					break;
					case validate\response::warn:
						$item->classes_outer[] = "warning";
					break;
					case validate\response::error:
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
	 * @return \streaky\form\validate\response
	 */
	public static function validateItem(\streaky\form\element\form &$form, $name, $value, $extra = false) {
		$class = $form->validate;
		$response = new validate\response();
		
		$item = $form->getItemByName($name);
		
		if($item instanceof \streaky\form\element\select) {
			if($item->enforce == true && !isset($item->options[$value])) {
				$item->value = $value = "";
			}
		}
		
		if($item->required == true && trim($value) == "") {
			$response->error = validate\response::error;
			$response->message = "This item is required";
			return $response;
		}
		
		$items = self::getValidationItems($class);
		if(!in_array($name, $items)) {
			// probably just a required field with no further validation
			$response->value = $value;
			$response->error = validate\response::ok;
			return $response;
		}
		
		try {
			$class::$name($value, $extra);
		} catch(validate\error $ex) {
			$response->error = validate\response::error;
			$response->message = $ex->getMessage();
		} catch(validate\warn $ex) {
			$response->error = validate\response::warn;
			$response->message = $ex->getMessage();
		} catch(validate\info $ex) {
			$response->error = validate\response::info;
			$response->message = $ex->getMessage();
		} catch(validate\ok $ex) {
			$response->message = $ex->getMessage();
		}
		$response->value = $value;
		return $response;
	}
}

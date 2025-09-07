<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Traits;

trait PostSearchCriteriaTrait
{
	public function __call($name, $arguments)
	{
		if (str_starts_with($name, 'get')) {
			$propertyName = lcfirst(substr($name, 3));
			if (property_exists($this, $propertyName)) {
				return $this->$propertyName;
			}
		}
		abort(404, "Method $name does not exist");
	}
}
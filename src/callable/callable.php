<?php

/*
 * This file is part of the zero package.
 * Copyright (c) 2012 olamedia <olamedia@gmail.com>
 *
 * This source code is release under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace zero;

/**
 * Represents a callable.
 * Callable can be:
 *		* an object with __invoke method
 *		* a \Closure
 *		* an array of object and method name
 *		* an array of class name and method name
 *		* a function
 */
class callable{
	protected $_callable = null;
	protected $_object = null; // an object, if passed with callable
	protected $_reflection = null; // \ReflectionFunctionAbstract
	public function __construct($callable){
		$this->_callable = $callable;
	}
	public static function create($callable){
		return new static($callable);
	}
	public function getParameters(){
		return $this->getMethod()->getParameters();
	}
	public function __invoke(){
		$args = \func_get_args();
		return $this->invokeArgs($args);
	}
	public function invoke(){
		return $this->invokeArgs();
	}
	public function invokeArgs(array $args = array()){
		$method = $this->getMethod();
		if ($method instanceof \ReflectionMethod){
			return $method->invokeArgs($this->_object, $args);
		}elseif ($method instanceof \ReflectionFunction){
			return $method->invokeArgs($args);
		}
		throw new \UnexpectedValueException();
	}
	public function getMethod(){
		if (null === $this->_reflection){
			$args = array();
			if (\is_array($this->_callable)){
				list($arg, $methodName) = $this->_callable;
				$object = null;
				if (\is_object($arg)){
					$this->_object = $arg;
					$class = new \ReflectionClass($this->_object);
					//$class = $reflectionObject->getClass();
				}else{
					$class = new \ReflectionClass($arg);
				}
				$this->_reflection = $class->getMethod($methodName);
			}elseif (\is_object($this->_callable)){
				if ($this->_callable instanceof \Closure){
					$this->_reflection =  new \ReflectionFunction($this->_callable); // 5.3.0
				}elseif (\method_exists($this->_callable, '__invoke')){
					$object = new \ReflectionObject($this->_callable);
					$class = $object->getClass();
					$this->_reflection = $class->getMethod('__invoke');
				}else{
					throw new \UnexpectedValueException();
				}
			}elseif(\is_string($this->_callable) && \function_exists($this->_callable)){
				$this->_reflection = new \ReflectionFunction($this->_callback);
			}else{
				throw new \UnexpectedValueException();
			}
		}
		return $this->_reflection;
	}
}



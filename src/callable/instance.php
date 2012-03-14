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
 * Represents an object instance
 * Usage example:
 *		$instance = instance::create(new object());
 *		$instance = $instance->getNewInstance(); // will clone object
 *		$instance->setShared();
 *		$instance = $instance->getNewInstance(); // will return initial object
 */
class instance{
	protected $_isShared = false;
	protected $_instance = null;
	public function __construct($object){
		$this->_instance = $object;
	}
	public static function create($object){
		return new self($object);
	}
	public function getNewInstance(){
		if (!$this->_isShared){
			return clone $this->_instance;
		}
		return $this->_instance;
	}
	public function share($share = true){
		return $this->setShared($share);
	}
	public function setShared($shared = true){
		$this->_isShared = $shared;
		return $this;
	}
	public function isShared(){
		return $this->_isShared;
	}
}



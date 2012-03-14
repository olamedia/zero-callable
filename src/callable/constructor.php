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
 * Represents a callable which constructs a value.
 * Usage example:
 *		$constructor = new constructor(function($var){ 
 *										return new object($var); 
 *									});
 *		$instance = $constructor->getNewInstance($var);
 */
class constructor extends callable{
	protected $_isShared = false;
	protected $_instance = null;
	public function getNewInstance(array $args = array()){
		if (!$this->_isShared || null === $this->_instance){
			$this->_instance = $this->invokeArgs($args);
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



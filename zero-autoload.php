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

use zero\classMapLoader;

classMapLoader::create(array(
	'callable' => 'callable.php',
	'constructor' => 'constructor.php',
	'instance' => 'instance.php',
), __DIR__.'/src/callable', 'zero');




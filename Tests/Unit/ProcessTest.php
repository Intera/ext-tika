<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Ingo Renner <ingo@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace ApacheSolrForTypo3\Tika;

use ApacheSolrForTypo3\Tika\Tests\Unit\ProcessTest;


/**
 * exec() mock to capture invocation parameters for the actual \exec() function
 *
 * @param $command
 * @param array $output
 */
function exec($command, array &$output) {
	ProcessTest::$execCommand = $command;
	$output = ProcessTest::$execOutput;
}


// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----


namespace ApacheSolrForTypo3\Tika\Tests\Unit;

use ApacheSolrForTypo3\Tika\Process;
use TYPO3\CMS\Core\Tests\UnitTestCase;


/**
 * Test case for class \ApacheSolrForTypo3\Tika\Process
 *
 */
class ProcessTest extends UnitTestCase {

	/**
	 * Allows to capture exec() parameters
	 *
	 * @var string
	 */
	public static $execCommand = '';

	/**
	 * Output to return to exec() calls
	 *
	 * @var array
	 */
	public static $execOutput = array();

	/**
	 * @test
	 */
	public function constructorSetsExecutableAndArguments() {
		$process = new Process('foo', '-bar');

		$this->assertEquals('foo', $process->getExecutable());
		$this->assertEquals('-bar', $process->getArguments());
	}

	/**
	 * Resets the exec() mock
	 */
	protected function resetExecMock() {
		self::$execCommand = '';
		self::$execOutput = array();
	}

}
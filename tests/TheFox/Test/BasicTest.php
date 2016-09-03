<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

class BasicTest extends PHPUnit_Framework_TestCase{
	
	public function testNum(){
		// $this->assertTrue(is_numeric('0xff'));
		$this->assertTrue(is_numeric(0xff));
		
		$this->assertEquals('AB', pack('v', 0x4241));
		$this->assertEquals('CD', pack('n', 0x4344));
	}
	
}

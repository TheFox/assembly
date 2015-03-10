<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

class BasicTestCase extends PHPUnit_Framework_TestCase{
	
	public function basicTest($instr, $expected, $len){
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals($expected, $opcode);
		$this->assertEquals($len, $instr->getLen());
	}
	
}

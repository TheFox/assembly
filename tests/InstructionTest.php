<?php

use TheFox\Assembly\Instruction;

class InstructionTest extends PHPUnit_Framework_TestCase{
	
	public function testSetOpcode(){
		$instr = new Instruction();
		$instr->setOpcode('90');
		$this->assertEquals('90', $instr->getOpcode());
		$this->assertEquals('90', $instr->assemble());
	}
	
}

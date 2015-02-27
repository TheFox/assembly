<?php

use TheFox\Assembly\Instruction\X86\Nop as X86Nop;

class NopTest extends PHPUnit_Framework_TestCase{
	
	public function testX86(){
		$instr = new X86Nop();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('90', $opcode);
	}
	
}

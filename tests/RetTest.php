<?php

use TheFox\Assembly\Instruction\X86\Ret as X86Ret;

class RetTest extends PHPUnit_Framework_TestCase{
	
	public function testX86(){
		$instr = new X86Ret();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('c3', $opcode);
	}
	
}

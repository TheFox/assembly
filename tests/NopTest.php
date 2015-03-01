<?php

use TheFox\Assembly\Instruction\X86\Nop as X86Nop;
use TheFox\Assembly\Instruction\I386\Nop as I386Nop;
use TheFox\Assembly\Instruction\X86_64\Nop as X8664Nop;

class NopTest extends PHPUnit_Framework_TestCase{
	
	public function testX86(){
		$instr = new X86Nop();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('90', $opcode);
	}
	
	public function testI386(){
		$instr = new I386Nop();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('90', $opcode);
	}
	
	public function testX8664(){
		$instr = new X8664Nop();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('90', $opcode);
	}
	
}

<?php

use TheFox\Assembly\Instruction\X86\Ret as X86Ret;
use TheFox\Assembly\Instruction\I386\Ret as I386Ret;
use TheFox\Assembly\Instruction\X86_64\Ret as X8664Ret;

class RetTest extends PHPUnit_Framework_TestCase{
	
	public function testX86(){
		$instr = new X86Ret();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('c3', $opcode);
	}
	
	public function testI386(){
		$instr = new I386Ret();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('c3', $opcode);
	}
	
	public function testX8664(){
		$instr = new X8664Ret();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('c3', $opcode);
	}
	
}

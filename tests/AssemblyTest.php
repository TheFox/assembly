<?php

use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction\X86\Nop;
use TheFox\Assembly\Instruction\X86\Ret;

class AssemblyTest extends PHPUnit_Framework_TestCase{
	
	public function testBasic(){
		$this->assertEquals('Assembly', Assembly::NAME);
	}
	
	public function testAssemble(){
		$asm = new Assembly();
		$asm->addInstruction(new Nop());
		$asm->addInstruction(new Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
}

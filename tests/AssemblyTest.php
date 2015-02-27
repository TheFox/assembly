<?php

use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction\X86\Nop as X86Nop;
use TheFox\Assembly\Instruction\X86\Ret as X86Ret;
use TheFox\Assembly\Instruction\I386\Nop as I386Nop;
use TheFox\Assembly\Instruction\I386\Ret as I386Ret;

class AssemblyTest extends PHPUnit_Framework_TestCase{
	
	public function testBasic(){
		$this->assertEquals('Assembly', Assembly::NAME);
	}
	
	public function testAssembleX86(){
		$asm = new Assembly();
		$asm->addInstruction(new X86Nop());
		$asm->addInstruction(new X86Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
	public function testAssembleI386(){
		$asm = new Assembly();
		$asm->addInstruction(new I386Nop());
		$asm->addInstruction(new I386Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
}

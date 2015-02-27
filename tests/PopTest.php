<?php

use TheFox\Assembly\Instruction\X86\Pop as X86Pop;
use TheFox\Assembly\Instruction\I386\Pop as I386Pop;

class PopTest extends PHPUnit_Framework_TestCase{
	
	public function testX86(){
		$instr = new X86Pop('ax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('58', $opcode);
		
		$instr = new X86Pop('cx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('59', $opcode);
		
		$instr = new X86Pop('dx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('5a', $opcode);
		
		$instr = new X86Pop('bx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('5b', $opcode);
	}
	
	public function testI386(){
		$instr = new I386Pop('ax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6658', $opcode);
		
		$instr = new I386Pop('cx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6659', $opcode);
		
		$instr = new I386Pop('dx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('665a', $opcode);
		
		$instr = new I386Pop('bx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('665b', $opcode);
		
		
		$instr = new I386Pop('eax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('58', $opcode);
		
		$instr = new I386Pop('ecx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('59', $opcode);
		
		$instr = new I386Pop('edx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('5a', $opcode);
		
		$instr = new I386Pop('ebx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('5b', $opcode);
	}
	
}

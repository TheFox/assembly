<?php

use TheFox\Assembly\Instruction\X86\Push as X86Push;
use TheFox\Assembly\Instruction\I386\Push as I386Push;
use TheFox\Assembly\Instruction\X86_64\Push as X8664Push;

class PushTest extends PHPUnit_Framework_TestCase{
	
	public function testX86(){
		$instr = new X86Push('ax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('50', $opcode);
		
		$instr = new X86Push('cx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('51', $opcode);
		
		$instr = new X86Push('dx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('52', $opcode);
		
		$instr = new X86Push('bx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('53', $opcode);
	}
	
	public function testI386(){
		$instr = new I386Push('ax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6650', $opcode);
		
		$instr = new I386Push('cx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6651', $opcode);
		
		$instr = new I386Push('dx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6652', $opcode);
		
		$instr = new I386Push('bx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6653', $opcode);
		
		
		$instr = new I386Push('eax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('50', $opcode);
		
		$instr = new I386Push('ecx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('51', $opcode);
		
		$instr = new I386Push('edx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('52', $opcode);
		
		$instr = new I386Push('ebx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('53', $opcode);
	}
	
	public function testX8664(){
		$instr = new X8664Push('ax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6650', $opcode);
		
		$instr = new X8664Push('cx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6651', $opcode);
		
		$instr = new X8664Push('dx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6652', $opcode);
		
		$instr = new X8664Push('bx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('6653', $opcode);
		
		
		$instr = new X8664Push('rax');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('50', $opcode);
		
		$instr = new X8664Push('rcx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('51', $opcode);
		
		$instr = new X8664Push('rdx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('52', $opcode);
		
		$instr = new X8664Push('rbx');
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('53', $opcode);
	}
	
	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionCode 1
	 */
	public function testX8664UnexpectedValueException(){
		$instr = new X8664Push('eax');
		$instr = new X8664Push('ecx');
		$instr = new X8664Push('edx');
		$instr = new X8664Push('ebx');
	}
	
}

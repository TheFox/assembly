<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Jmp as X8086Jmp;
use TheFox\Assembly\Instruction\I386\Jmp as I386Jmp;
use TheFox\Assembly\Instruction\X86_64\Jmp as X8664Jmp;

class JmpTest extends BasicTestCase{
	
	public function test8086(){
		#$this->basicTest(new X8086Jmp($register), $expected);
		
		/*$instr = new X8086Jmp();
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('90', $opcode);*/
	}
	
	/*public function testI386(){
		
	}
	
	public function testX8664(){
		
	}*/
	
}

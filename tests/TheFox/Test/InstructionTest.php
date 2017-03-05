<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;
use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction;

class InstructionTest extends PHPUnit_Framework_TestCase{
	
	public function testSetAssembly(){
		$instr = new Instruction();
		
		$asm = new Assembly();
		$asm->addInstruction($instr);
		
		$this->assertEquals($asm, $instr->getAssembly());
	}
	
	public function testSetOpcode(){
		$instr = new Instruction();
		$instr->setOpcode('90');
		
		$this->assertEquals('90', $instr->getOpcode());
		$this->assertEquals('90', $instr->assemble());
	}
	
}

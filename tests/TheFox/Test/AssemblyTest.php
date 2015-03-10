<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction\X86\Nop as X8086Nop;
use TheFox\Assembly\Instruction\X86\Ret as X8086Ret;
use TheFox\Assembly\Instruction\I386\Nop as I386Nop;
use TheFox\Assembly\Instruction\I386\Ret as I386Ret;
use TheFox\Assembly\Instruction\X86_64\Nop as X8664Nop;
use TheFox\Assembly\Instruction\X86_64\Ret as X8664Ret;

class AssemblyTest extends PHPUnit_Framework_TestCase{
	
	public function testBasic(){
		$this->assertEquals('Assembly', Assembly::NAME);
	}
	
	public function testExtensions(){
		$this->assertTrue(extension_loaded('bcmath'));
	}
	
	public function testAssemble8086Base(){
		$asm = new Assembly();
		$asm->addInstruction(new X8086Nop());
		$asm->addInstruction(new X8086Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
	public function testAssembleI386Base(){
		$asm = new Assembly();
		$asm->addInstruction(new I386Nop());
		$asm->addInstruction(new I386Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
	public function testAssembleX8664Base(){
		$asm = new Assembly();
		$asm->addInstruction(new X8664Nop());
		$asm->addInstruction(new X8664Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
	public function testNum(){
		$this->assertTrue(is_numeric('0xff'));
		$this->assertTrue(is_numeric(0xff));
		
		$this->assertEquals('AB', pack('v', 0x4241));
		$this->assertEquals('CD', pack('n', 0x4344));
	}
	
}

<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction as BaseInstruction;
use TheFox\Assembly\Instruction\X86\Nop as X8086Nop;
use TheFox\Assembly\Instruction\X86\Ret as X8086Ret;
use TheFox\Assembly\Instruction\X86\Mov as X8086Mov;
use TheFox\Assembly\Instruction\X86\Jmp as X8086Jmp;
use TheFox\Assembly\Instruction\I386\Nop as I386Nop;
use TheFox\Assembly\Instruction\I386\Ret as I386Ret;
use TheFox\Assembly\Instruction\I386\Mov as I386Mov;
use TheFox\Assembly\Instruction\I386\Jmp as I386Jmp;
use TheFox\Assembly\Instruction\X86_64\Nop as X8664Nop;
use TheFox\Assembly\Instruction\X86_64\Ret as X8664Ret;
use TheFox\Assembly\Instruction\X86_64\Mov as X8664Mov;
use TheFox\Assembly\Instruction\X86_64\Jmp as X8664Jmp;

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
	
	public function testAssemble8086Offset(){
		$nopInstr1 = new X8086Nop();
		$nopInstr2 = new X8086Nop();
		$bInstr1 = new BaseInstruction();
		$retInstr = new X8086Ret();
		
		$bInstr1->setOpcode('909090');
		$bInstr1->setLen(3);
		
		$asm = new Assembly();
		$asm->addInstruction($nopInstr1);
		$asm->addInstruction($nopInstr2);
		$asm->addInstruction($bInstr1);
		$asm->addInstruction($retInstr);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(5, $retInstr->getOffset());
		
		
		$bInstr1->setOpcode('90');
		$bInstr1->setLen(1);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(3, $retInstr->getOffset());
		
		
		$bInstr1->setOpcode('90909090');
		$bInstr1->setLen(4);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(6, $retInstr->getOffset());
	}
	
	public function testAssembleI386Base(){
		$asm = new Assembly();
		$asm->addInstruction(new I386Nop());
		$asm->addInstruction(new I386Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
	public function testAssembleI386Offset(){
		$nopInstr1 = new I386Nop();
		$nopInstr2 = new I386Nop();
		$bInstr1 = new BaseInstruction();
		$retInstr = new I386Ret();
		
		$bInstr1->setOpcode('909090');
		$bInstr1->setLen(3);
		
		$asm = new Assembly();
		$asm->addInstruction($nopInstr1);
		$asm->addInstruction($nopInstr2);
		$asm->addInstruction($bInstr1);
		$asm->addInstruction($retInstr);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(5, $retInstr->getOffset());
		
		
		$bInstr1->setOpcode('90');
		$bInstr1->setLen(1);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(3, $retInstr->getOffset());
		
		
		$bInstr1->setOpcode('90909090');
		$bInstr1->setLen(4);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(6, $retInstr->getOffset());
	}
	
	public function testAssembleX8664Base(){
		$asm = new Assembly();
		$asm->addInstruction(new X8664Nop());
		$asm->addInstruction(new X8664Ret());
		
		$opcode = unpack('H*', $asm->assemble());
		$opcode = $opcode[1];
		
		$this->assertEquals('90c3', $opcode);
	}
	
	public function testAssembleX8664Offset(){
		$nopInstr1 = new X8664Nop();
		$nopInstr2 = new X8664Nop();
		$bInstr1 = new BaseInstruction();
		$retInstr = new X8664Ret();
		
		$bInstr1->setOpcode('909090');
		$bInstr1->setLen(3);
		
		$asm = new Assembly();
		$asm->addInstruction($nopInstr1);
		$asm->addInstruction($nopInstr2);
		$asm->addInstruction($bInstr1);
		$asm->addInstruction($retInstr);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(5, $retInstr->getOffset());
		
		
		$bInstr1->setOpcode('90');
		$bInstr1->setLen(1);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(3, $retInstr->getOffset());
		
		
		$bInstr1->setOpcode('90909090');
		$bInstr1->setLen(4);
		
		$this->assertEquals(0, $nopInstr1->getOffset());
		$this->assertEquals(1, $nopInstr2->getOffset());
		$this->assertEquals(2, $bInstr1->getOffset());
		$this->assertEquals(6, $retInstr->getOffset());
	}
	
	public function testAssembleX8664Jmp(){
		$retInstr = new X8664Ret();
		
		$asm = new Assembly();
		$asm->addInstruction(new X8664Mov('rax', 'rbx'));
		$asm->addInstruction(new X8664Jmp($retInstr));
		#$asm->addInstruction(new X8664Nop());
		#$asm->addInstruction($retInstr);
		#$asm->addInstruction(new X8664Nop());
		
		$opcode = $asm->assemble();
		
		$hex = unpack('H*', $opcode);
		$hex = $hex[1];
		$this->assertEquals('4889c3', $hex);
	}
	
}

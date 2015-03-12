<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction;
use TheFox\Assembly\Instruction\X86\Jmp as X8086Jmp;
use TheFox\Assembly\Instruction\I386\Jmp as I386Jmp;
use TheFox\Assembly\Instruction\X86_64\Jmp as X8664Jmp;

class JmpTest extends BasicTestCase{
	
	public function x8086ValueProvider(){
		$rv = array();
		
		$rv[] = array('', '', 0);
		
		$rv[] = array(-0x8001, '', 0);
		
		$rv[] = array(-0x8000, 'e90080', 3);
		$rv[] = array(-0x7fff, 'e90180', 3);
		$rv[] = array(-0x7ffe, 'e90280', 3);
		
		$rv[] = array(-0x1001, 'e9ffef', 3);
		$rv[] = array(-0x1000, 'e900f0', 3);
		$rv[] = array(-0xfff, 'e901f0', 3);
		$rv[] = array(-0xffe, 'e902f0', 3);
		
		$rv[] = array(-0x801, 'e9fff7', 3);
		$rv[] = array(-0x800, 'e900f8', 3);
		$rv[] = array(-0x7ff, 'e901f8', 3);
		$rv[] = array(-0x7fe, 'e902f8', 3);
		
		$rv[] = array(-0x101, 'e9fffe', 3);
		$rv[] = array(-0x100, 'e900ff', 3);
		$rv[] = array(-0xff, 'e901ff', 3);
		$rv[] = array(-0xfe, 'e902ff', 3);
		
		$rv[] = array(-0x83, 'e97dff', 3);
		$rv[] = array(-0x82, 'e97eff', 3);
		$rv[] = array(-0x81, 'e97fff', 3);
		
		$rv[] = array(-0x80, 'eb80', 2);
		$rv[] = array(-0x7f, 'eb81', 2);
		$rv[] = array(-0x7e, 'eb82', 2);
		
		$rv[] = array(-2, 'ebfe', 2);
		$rv[] = array(-1, 'ebff', 2);
		$rv[] = array(0, 'eb00', 2);
		$rv[] = array(1, 'eb01', 2);
		$rv[] = array(2, 'eb02', 2);
		
		$rv[] = array(0x7e, 'eb7e', 2);
		$rv[] = array(0x7f, 'eb7f', 2);
		
		$rv[] = array(0x80, 'e98000', 3);
		$rv[] = array(0x81, 'e98100', 3);
		$rv[] = array(0xff, 'e9ff00', 3);
		$rv[] = array(0x100, 'e90001', 3);
		$rv[] = array(0x101, 'e90101', 3);
		
		$rv[] = array(0x7fff, 'e9ff7f', 3);
		
		$rv[] = array(0x8000, '', 0);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8086ValueProvider
	 */
	public function test8086Value($offset, $expected, $len){
		$this->basicTest(new X8086Jmp($offset), $expected, $len);
	}
	
	public function x8086ObjectProvider(){
		$rv = array();
		
		$rv[] = array(6, 8, 'eb00');
		$rv[] = array(6, 7, 'ebff');
		$rv[] = array(6, 9, 'eb01');
		$rv[] = array(0, 0x80, 'eb7e');
		$rv[] = array(0, 0x80 + 1, 'eb7f');
		$rv[] = array(0, 0x80 + 2, 'e98000');
		$rv[] = array(0, 0x80 + 3, 'e98100');
		$rv[] = array(0, 0xf00 + 0x80, 'e97e0f');
		$rv[] = array(0, 0xf00 + 0x80 + 3, 'e9810f');
		
		$rv[] = array(8, 7, 'ebfd');
		$rv[] = array(150, 149, 'ebfd');
		$rv[] = array(1500, 1499, 'ebfd');
		
		$rv[] = array(0x7e, 0, 'eb80');
		$rv[] = array(0x7f, 0, 'e97eff');
		$rv[] = array(0x80, 0, 'e97dff');
		
		$rv[] = array(0, 0, 'ebfe');
		$rv[] = array(150, 150, 'ebfe');
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8086ObjectProvider
	 */
	public function test8086Object($offsetJmp, $offsetInstr, $expected){
		$instr1 = new Instruction();
		$instr1->setOffset($offsetInstr);
		
		$jmp1 = new X8086Jmp($instr1);
		$jmp1->setOffset($offsetJmp);
		
		$opcode = unpack('H*', $jmp1->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function test8086Self(){
		$jmp1 = new X8086Jmp(0);
		$jmp1->dst = $jmp1;
		$jmp1->setOffset(10);
		
		$opcode = unpack('H*', $jmp1->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('ebfe', $opcode);
	}
	
}

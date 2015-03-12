<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction;
use TheFox\Assembly\Instruction\X86\Jmp as X8086Jmp;
use TheFox\Assembly\Instruction\I386\Jmp as I386Jmp;
use TheFox\Assembly\Instruction\X86_64\Jmp as X8664Jmp;

class JmpTest extends BasicTestCase{
	
	public function x8086ValueProvider(){
		$rv = array();
		
		$rv[] = array('', '', 2);
		
		$rv[] = array(-0x8001, '', 2);
		
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
		
		$rv[] = array(0x8000, '', 2);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8086ValueProvider
	 */
	public function test8086Value($offset, $expected, $len){
		$this->basicTest(new X8086Jmp($offset), $expected, $len);
	}
	
	public function x8086StringProvider(){
		$rv = array();
		
		$rv[] = array('ax', 'ffe0', 2);
		$rv[] = array('cx', 'ffe1', 2);
		$rv[] = array('dx', 'ffe2', 2);
		$rv[] = array('bx', 'ffe3', 2);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8086StringProvider
	 */
	public function test8086String($register, $expected, $len){
		$this->basicTest(new X8086Jmp($register), $expected, $len);
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
	
	public function i386ValueProvider(){
		$rv = array();
		
		$rv[] = array('', '', 2);
		
		$rv[] = array(-0x80000001, '', 2);
		
		$rv[] = array(-0x80000000, 'e900000080', 5);
		$rv[] = array(-0x7fffffff, 'e901000080', 5);
		$rv[] = array(-0x7ffffffe, 'e902000080', 5);
		
		$rv[] = array(-0x1001, 'e9ffefffff', 5);
		$rv[] = array(-0x1000, 'e900f0ffff', 5);
		$rv[] = array(-0xfff, 'e901f0ffff', 5);
		$rv[] = array(-0xffe, 'e902f0ffff', 5);
		
		$rv[] = array(-0x801, 'e9fff7ffff', 5);
		$rv[] = array(-0x800, 'e900f8ffff', 5);
		$rv[] = array(-0x7ff, 'e901f8ffff', 5);
		$rv[] = array(-0x7fe, 'e902f8ffff', 5);
		
		$rv[] = array(-0x101, 'e9fffeffff', 5);
		$rv[] = array(-0x100, 'e900ffffff', 5);
		$rv[] = array(-0xff, 'e901ffffff', 5);
		$rv[] = array(-0xfe, 'e902ffffff', 5);
		
		$rv[] = array(-0x83, 'e97dffffff', 5);
		$rv[] = array(-0x82, 'e97effffff', 5);
		$rv[] = array(-0x81, 'e97fffffff', 5);
		
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
		
		$rv[] = array(0x80, 'e980000000', 5);
		$rv[] = array(0x81, 'e981000000', 5);
		$rv[] = array(0xff, 'e9ff000000', 5);
		$rv[] = array(0x100, 'e900010000', 5);
		$rv[] = array(0x101, 'e901010000', 5);
		
		$rv[] = array(0x7fffffff, 'e9ffffff7f', 5);
		
		$rv[] = array(0x80000000, '', 2);
		
		return $rv;
	}
	
	/**
	 * @dataProvider i386ValueProvider
	 */
	public function testI386Value($offset, $expected, $len){
		$this->basicTest(new I386Jmp($offset), $expected, $len);
	}
	
	public function i386StringProvider(){
		$rv = array();
		
		$rv[] = array('ax', '66ffe0', 3);
		$rv[] = array('cx', '66ffe1', 3);
		$rv[] = array('dx', '66ffe2', 3);
		$rv[] = array('bx', '66ffe3', 3);
		
		$rv[] = array('eax', 'ffe0', 2);
		$rv[] = array('ecx', 'ffe1', 2);
		$rv[] = array('edx', 'ffe2', 2);
		$rv[] = array('ebx', 'ffe3', 2);
		
		return $rv;
	}
	
	/**
	 * @dataProvider i386StringProvider
	 */
	public function testI386String($register, $expected, $len){
		$this->basicTest(new I386Jmp($register), $expected, $len);
	}
	
	public function i386ObjectProvider(){
		$rv = array();
		
		$rv[] = array(6, 8, 'eb00');
		$rv[] = array(6, 7, 'ebff');
		$rv[] = array(6, 9, 'eb01');
		$rv[] = array(0, 0x80, 'eb7e');
		$rv[] = array(0, 0x80 + 1, 'eb7f');
		$rv[] = array(0, 0x80 + 2, 'e980000000');
		$rv[] = array(0, 0x80 + 3, 'e981000000');
		$rv[] = array(0, 0xf00 + 0x80, 'e97e0f0000');
		$rv[] = array(0, 0xf00 + 0x80 + 3, 'e9810f0000');
		
		$rv[] = array(8, 7, 'ebfd');
		$rv[] = array(150, 149, 'ebfd');
		$rv[] = array(1500, 1499, 'ebfd');
		
		$rv[] = array(0x7e, 0, 'eb80');
		$rv[] = array(0x7f, 0, 'e97cffffff');
		$rv[] = array(0x80, 0, 'e97bffffff');
		
		$rv[] = array(0, 0, 'ebfe');
		$rv[] = array(150, 150, 'ebfe');
		
		return $rv;
	}
	
	/**
	 * @dataProvider i386ObjectProvider
	 */
	public function testI386Object($offsetJmp, $offsetInstr, $expected){
		$instr1 = new Instruction();
		$instr1->setOffset($offsetInstr);
		
		$jmp1 = new I386Jmp($instr1);
		$jmp1->setOffset($offsetJmp);
		
		$opcode = unpack('H*', $jmp1->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function testI386Self(){
		$jmp1 = new I386Jmp(0);
		$jmp1->dst = $jmp1;
		$jmp1->setOffset(10);
		
		$opcode = unpack('H*', $jmp1->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('ebfe', $opcode);
	}
	
	public function x8664ValueProvider(){
		$rv = array();
		
		$rv[] = array('', '', 2);
		
		$rv[] = array(-0x80000001, '', 2);
		
		$rv[] = array(-0x80000000, 'e900000080', 5);
		$rv[] = array(-0x7fffffff, 'e901000080', 5);
		$rv[] = array(-0x7ffffffe, 'e902000080', 5);
		
		$rv[] = array(-0x1001, 'e9ffefffff', 5);
		$rv[] = array(-0x1000, 'e900f0ffff', 5);
		$rv[] = array(-0xfff, 'e901f0ffff', 5);
		$rv[] = array(-0xffe, 'e902f0ffff', 5);
		
		$rv[] = array(-0x801, 'e9fff7ffff', 5);
		$rv[] = array(-0x800, 'e900f8ffff', 5);
		$rv[] = array(-0x7ff, 'e901f8ffff', 5);
		$rv[] = array(-0x7fe, 'e902f8ffff', 5);
		
		$rv[] = array(-0x101, 'e9fffeffff', 5);
		$rv[] = array(-0x100, 'e900ffffff', 5);
		$rv[] = array(-0xff, 'e901ffffff', 5);
		$rv[] = array(-0xfe, 'e902ffffff', 5);
		
		$rv[] = array(-0x83, 'e97dffffff', 5);
		$rv[] = array(-0x82, 'e97effffff', 5);
		$rv[] = array(-0x81, 'e97fffffff', 5);
		
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
		
		$rv[] = array(0x80, 'e980000000', 5);
		$rv[] = array(0x81, 'e981000000', 5);
		$rv[] = array(0xff, 'e9ff000000', 5);
		$rv[] = array(0x100, 'e900010000', 5);
		$rv[] = array(0x101, 'e901010000', 5);
		
		$rv[] = array(0x7fffffff, 'e9ffffff7f', 5);
		
		$rv[] = array(0x80000000, '', 2);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8664ValueProvider
	 */
	public function test8664Value($offset, $expected, $len){
		$this->basicTest(new X8664Jmp($offset), $expected, $len);
	}
	
	public function x8664StringProvider(){
		$rv = array();
		
		$rv[] = array('ax', '66ffe0', 3);
		$rv[] = array('cx', '66ffe1', 3);
		$rv[] = array('dx', '66ffe2', 3);
		$rv[] = array('bx', '66ffe3', 3);
		
		$rv[] = array('rax', 'ffe0', 2);
		$rv[] = array('rcx', 'ffe1', 2);
		$rv[] = array('rdx', 'ffe2', 2);
		$rv[] = array('rbx', 'ffe3', 2);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8664StringProvider
	 */
	public function testX8664String($register, $expected, $len){
		$this->basicTest(new X8664Jmp($register), $expected, $len);
	}
	
	public function x8664ObjectProvider(){
		$rv = array();
		
		$rv[] = array(6, 8, 'eb00');
		$rv[] = array(6, 7, 'ebff');
		$rv[] = array(6, 9, 'eb01');
		$rv[] = array(0, 0x80, 'eb7e');
		$rv[] = array(0, 0x80 + 1, 'eb7f');
		$rv[] = array(0, 0x80 + 2, 'e980000000');
		$rv[] = array(0, 0x80 + 3, 'e981000000');
		$rv[] = array(0, 0xf00 + 0x80, 'e97e0f0000');
		$rv[] = array(0, 0xf00 + 0x80 + 3, 'e9810f0000');
		
		$rv[] = array(8, 7, 'ebfd');
		$rv[] = array(150, 149, 'ebfd');
		$rv[] = array(1500, 1499, 'ebfd');
		
		$rv[] = array(0x7e, 0, 'eb80');
		$rv[] = array(0x7f, 0, 'e97cffffff');
		$rv[] = array(0x80, 0, 'e97bffffff');
		
		$rv[] = array(0, 0, 'ebfe');
		$rv[] = array(150, 150, 'ebfe');
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8664ObjectProvider
	 */
	public function test8664Object($offsetJmp, $offsetInstr, $expected){
		$instr1 = new Instruction();
		$instr1->setOffset($offsetInstr);
		
		$jmp1 = new X8664Jmp($instr1);
		$jmp1->setOffset($offsetJmp);
		
		$opcode = unpack('H*', $jmp1->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function testX8664Self(){
		$jmp1 = new X8664Jmp(0);
		$jmp1->dst = $jmp1;
		$jmp1->setOffset(10);
		
		$opcode = unpack('H*', $jmp1->assemble());
		$opcode = $opcode[1];
		$this->assertEquals('ebfe', $opcode);
	}
	
}

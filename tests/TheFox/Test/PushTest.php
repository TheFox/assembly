<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Instruction\X86\Push as X86Push;
use TheFox\Assembly\Instruction\I386\Push as I386Push;
use TheFox\Assembly\Instruction\X86_64\Push as X8664Push;

class PushTest extends PHPUnit_Framework_TestCase{
	
	public function testX86Provider(){
		$rv = array();
		
		$rv[] = array('', '');
		$rv[] = array('XYZ', '');
		
		$rv[] = array('ax', '50');
		$rv[] = array('cx', '51');
		$rv[] = array('dx', '52');
		$rv[] = array('bx', '53');
		
		return $rv;
	}
	
	/**
	 * @dataProvider testX86Provider
	 */
	public function test8086($register, $expected){
		$instr = new X86Push($register);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function testI386Provider(){
		$rv = array();
		
		$rv[] = array('', '');
		$rv[] = array('XYZ', '');
		
		$rv[] = array('ax', '6650');
		$rv[] = array('cx', '6651');
		$rv[] = array('dx', '6652');
		$rv[] = array('bx', '6653');
		
		$rv[] = array('eax', '50');
		$rv[] = array('ecx', '51');
		$rv[] = array('edx', '52');
		$rv[] = array('ebx', '53');
		
		return $rv;
	}
	
	/**
	 * @dataProvider testI386Provider
	 */
	public function testI386($register, $expected){
		$instr = new I386Push($register);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function testX8664Provider(){
		$rv = array();
		
		$rv[] = array('', '');
		$rv[] = array('XYZ', '');
		
		$rv[] = array('ax', '6650');
		$rv[] = array('cx', '6651');
		$rv[] = array('dx', '6652');
		$rv[] = array('bx', '6653');
		
		$rv[] = array('rax', '50');
		$rv[] = array('rcx', '51');
		$rv[] = array('rdx', '52');
		$rv[] = array('rbx', '53');
		
		return $rv;
	}
	
	/**
	 * @dataProvider testX8664Provider
	 */
	public function testX8664($register, $expected){
		$instr = new X8664Push($register);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
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

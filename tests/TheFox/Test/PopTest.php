<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Instruction\X86\Pop as X86Pop;
use TheFox\Assembly\Instruction\I386\Pop as I386Pop;
use TheFox\Assembly\Instruction\X86_64\Pop as X8664Pop;

class PopTest extends PHPUnit_Framework_TestCase{
	
	public function testX86Provider(){
		$rv = array();
		
		$rv[] = array('', '');
		$rv[] = array('XYZ', '');
		
		$rv[] = array('ax', '58');
		$rv[] = array('cx', '59');
		$rv[] = array('dx', '5a');
		$rv[] = array('bx', '5b');
		
		return $rv;
	}
	
	/**
	 * @dataProvider testX86Provider
	 */
	public function test8086($register, $expected){
		$instr = new X86Pop($register);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function testI386Provider(){
		$rv = array();
		
		$rv[] = array('', '');
		$rv[] = array('XYZ', '');
		
		$rv[] = array('ax', '6658');
		$rv[] = array('cx', '6659');
		$rv[] = array('dx', '665a');
		$rv[] = array('bx', '665b');
		
		$rv[] = array('eax', '58');
		$rv[] = array('ecx', '59');
		$rv[] = array('edx', '5a');
		$rv[] = array('ebx', '5b');
		
		return $rv;
	}
	
	/**
	 * @dataProvider testI386Provider
	 */
	public function testI386($register, $expected){
		$instr = new I386Pop($register);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function testX8664Provider(){
		$rv = array();
		
		$rv[] = array('', '');
		$rv[] = array('XYZ', '');
		
		$rv[] = array('ax', '6658');
		$rv[] = array('cx', '6659');
		$rv[] = array('dx', '665a');
		$rv[] = array('bx', '665b');
		
		$rv[] = array('rax', '58');
		$rv[] = array('rcx', '59');
		$rv[] = array('rdx', '5a');
		$rv[] = array('rbx', '5b');
		
		return $rv;
	}
	
	/**
	 * @dataProvider testX8664Provider
	 */
	public function testX8664($register, $expected){
		$instr = new X8664Pop($register);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionCode 1
	 */
	public function testX8664UnexpectedValueException(){
		$instr = new X8664Pop('eax');
		$instr = new X8664Pop('ecx');
		$instr = new X8664Pop('edx');
		$instr = new X8664Pop('ebx');
	}
	
}

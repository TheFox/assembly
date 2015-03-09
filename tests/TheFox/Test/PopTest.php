<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Pop as X8086Pop;
use TheFox\Assembly\Instruction\I386\Pop as I386Pop;
use TheFox\Assembly\Instruction\X86_64\Pop as X8664Pop;

class PopTest extends BasicTestCase{
	
	public function x8086Provider(){
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
	 * @dataProvider x8086Provider
	 */
	public function test8086($register, $expected){
		$this->basicTest(new X8086Pop($register), $expected);
	}
	
	public function i386Provider(){
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
	 * @dataProvider i386Provider
	 */
	public function testI386($register, $expected){
		$this->basicTest(new I386Pop($register), $expected);
	}
	
	public function x8664Provider(){
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
	 * @dataProvider x8664Provider
	 */
	public function testX8664($register, $expected){
		$this->basicTest(new X8664Pop($register), $expected);
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

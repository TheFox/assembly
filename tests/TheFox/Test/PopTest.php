<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Pop as X8086Pop;
use TheFox\Assembly\Instruction\I386\Pop as I386Pop;
use TheFox\Assembly\Instruction\X86_64\Pop as X8664Pop;

class PopTest extends BasicTestCase{
	
	public function x8086Provider(){
		$rv = array();
		
		$rv[] = array('', '', 0);
		$rv[] = array('XYZ', '', 0);
		
		$rv[] = array('ax', '58', 1);
		$rv[] = array('cx', '59', 1);
		$rv[] = array('dx', '5a', 1);
		$rv[] = array('bx', '5b', 1);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8086Provider
	 */
	public function test8086($register, $expected, $len){
		$this->basicTest(new X8086Pop($register), $expected, $len);
	}
	
	public function i386Provider(){
		$rv = array();
		
		$rv[] = array('', '', 0);
		$rv[] = array('XYZ', '', 0);
		
		$rv[] = array('ax', '6658', 2);
		$rv[] = array('cx', '6659', 2);
		$rv[] = array('dx', '665a', 2);
		$rv[] = array('bx', '665b', 2);
		
		$rv[] = array('eax', '58', 1);
		$rv[] = array('ecx', '59', 1);
		$rv[] = array('edx', '5a', 1);
		$rv[] = array('ebx', '5b', 1);
		
		return $rv;
	}
	
	/**
	 * @dataProvider i386Provider
	 */
	public function testI386($register, $expected, $len){
		$this->basicTest(new I386Pop($register), $expected, $len);
	}
	
	public function x8664Provider(){
		$rv = array();
		
		$rv[] = array('', '', 0);
		$rv[] = array('XYZ', '', 0);
		
		$rv[] = array('ax', '6658', 2);
		$rv[] = array('cx', '6659', 2);
		$rv[] = array('dx', '665a', 2);
		$rv[] = array('bx', '665b', 2);
		
		// throws Exception, see testX8664UnexpectedValueException()
		// $rv[] = array('eax', '58', 1);
		// $rv[] = array('ecx', '59', 1);
		// $rv[] = array('edx', '5a', 1);
		// $rv[] = array('ebx', '5b', 1);
		
		$rv[] = array('rax', '58', 1);
		$rv[] = array('rcx', '59', 1);
		$rv[] = array('rdx', '5a', 1);
		$rv[] = array('rbx', '5b', 1);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8664Provider
	 */
	public function testX8664($register, $expected, $len){
		$this->basicTest(new X8664Pop($register), $expected, $len);
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

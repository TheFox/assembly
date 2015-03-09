<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Push as X8086Push;
use TheFox\Assembly\Instruction\I386\Push as I386Push;
use TheFox\Assembly\Instruction\X86_64\Push as X8664Push;

class PushTest extends BasicTestCase{
	
	public function x8086Provider(){
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
	 * @dataProvider x8086Provider
	 */
	public function test8086($register, $expected){
		$this->basicTest(new X8086Push($register), $expected);
	}
	
	public function i386Provider(){
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
	 * @dataProvider i386Provider
	 */
	public function testI386($register, $expected){
		$this->basicTest(new I386Push($register), $expected);
	}
	
	public function x8664Provider(){
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
	 * @dataProvider x8664Provider
	 */
	public function testX8664($register, $expected){
		$this->basicTest(new X8664Push($register), $expected);
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

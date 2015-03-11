<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Jmp as X8086Jmp;
use TheFox\Assembly\Instruction\I386\Jmp as I386Jmp;
use TheFox\Assembly\Instruction\X86_64\Jmp as X8664Jmp;

class JmpTest extends BasicTestCase{
	
	public function x8086Provider(){
		$rv = array();
		
		$rv[] = array('', '', 0);
		
		$rv[] = array(-0x80, 'eb80', 2);
		$rv[] = array(-0x7f, 'eb81', 2);
		$rv[] = array(-0x7e, 'eb82', 2);
		
		$rv[] = array(-2, 'ebfe', 2);
		$rv[] = array(-1, 'ebff', 2);
		$rv[] = array(0, 'eb00', 2);
		$rv[] = array(1, 'eb01', 2);
		$rv[] = array(2, 'eb02', 2);
		
		$rv[] = array(0x7f, 'eb7f', 2);
		#$rv[] = array(0x80, 'e980000000', 5);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8086Provider
	 */
	public function test8086($register, $expected, $len){
		$this->basicTest(new X8086Jmp($register), $expected, $len);
	}
	
	/*public function testI386(){
		
	}
	
	public function testX8664(){
		
	}*/
	
}

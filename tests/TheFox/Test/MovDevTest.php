<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86_64\Mov as X8664Mov;

class MovDevTest extends BasicTestCase{
	
	public function x8664ProviderDev(){
		$rv = array();
		
		$rv[] = array('eax', 'eax', '89c0', 2);
		$rv[] = array('rax', 'rax', '4889c0', 3);
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8664ProviderDev
	 */
	public function testX8664dev($src, $dst, $expected, $len){
		$this->basicTest(new X8664Mov($src, $dst), $expected, $len);
	}
	
}

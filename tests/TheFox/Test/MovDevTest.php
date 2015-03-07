<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Instruction\X86_64\Mov as X8664Mov;

class MovDevTest extends PHPUnit_Framework_TestCase{
	
	public function x8664ProviderDev(){
		$rv = array();
		
		$rv[] = array('eax', 'eax', '89c0');
		$rv[] = array('rax', 'rax', '4889c0');
		
		return $rv;
	}
	
	/**
	 * @dataProvider x8664ProviderDev
	 */
	public function testX8664dev($src, $dst, $expected){
		$instr = new X8664Mov($src, $dst);
		#$instr = new I386Mov($src, $dst);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
}

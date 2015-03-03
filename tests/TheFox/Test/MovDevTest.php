<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Instruction\X86_64\Mov as X8664Mov;

class MovDevTest extends PHPUnit_Framework_TestCase{
	
	public function x8664ProviderDev(){
		$rv = array();
		
		$rv[] = array(-1,         'eax', 'b8ffffffff');
		$rv[] = array(0x7fffffff, 'eax', 'b8ffffff7f');
		$rv[] = array(0x80, 'eax', 'b880000000');
		$rv[] = array(0x80000000, 'eax', 'b800000080');
		$rv[] = array(0x80000001, 'eax', 'b801000080');
		$rv[] = array(0xffffffff, 'eax', 'b8ffffffff');
		
		
		#$rv[] = array(-1,         'rax', '48c7c0ffffffff');
		$rv[] = array(0x7fffffff, 'rax', '48c7c0ffffff7f');
		
		$rv[] = array(0x80000000, 'rax', '48b80000008000000000');
		$rv[] = array(0x80000001, 'rax', '48b80100008000000000');
		$rv[] = array(0xffffffff, 'rax', '48b8ffffffff00000000');
		
		$rv[] = array(0x7fffffff00000000, 'rax', '48b800000000ffffff7f');
		$rv[] = array(0x8000000000000000, 'rax', '48b80000000000000080');
		
		#$rv[] = array(-0x8000000000000000, 'rax', '48b80000000000000080');
		#$rv[] = array(-0x7fffffff00000000, 'rax', '48b80000000001000080');
		
		#$rv[] = array(-0x80000000, 'rax', '48c7c000000080');
		#$rv[] = array(-0x7fffffff, 'rax', '48c7c001000080');
		
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

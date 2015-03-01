<?php

use TheFox\Assembly\Instruction\X86\Mov as X86Mov;
use TheFox\Assembly\Instruction\I386\Mov as I386Mov;
use TheFox\Assembly\Instruction\X86_64\Mov as X8664Mov;

class MovTest extends PHPUnit_Framework_TestCase{
	
	public function testBasic(){
		$this->assertTrue(is_numeric('0xff'));
		$this->assertTrue(is_numeric(0xff));
		
		$this->assertEquals('AB', pack('v', 0x4241));
		$this->assertEquals('CD', pack('n', 0x4344));
	}
	
	public function testX86Provider(){
		$rv = array();
		
		$rv[] = array(0, 'al', 'b000');
		$rv[] = array(127, 'al', 'b07f');
		$rv[] = array(128, 'al', 'b080');
		$rv[] = array(255, 'al', 'b0ff');
		$rv[] = array(256, 'al', 'b000');
		$rv[] = array(0xff, 'al', 'b0ff');
		$rv[] = array(0x102, 'al', 'b002');
		$rv[] = array(1024, 'al', 'b000');
		
		$rv[] = array(0, 'ah', 'b400');
		$rv[] = array(127, 'ah', 'b47f');
		$rv[] = array(128, 'ah', 'b480');
		$rv[] = array(255, 'ah', 'b4ff');
		$rv[] = array(256, 'ah', 'b400');
		$rv[] = array(0xff, 'ah', 'b4ff');
		$rv[] = array(0x102, 'ah', 'b402');
		$rv[] = array(1024, 'ah', 'b400');
		$rv[] = array(1024 + 127, 'ah', 'b47f');
		
		$rv[] = array(0, 'ax', 'b80000');
		$rv[] = array(127, 'ax', 'b87f00');
		$rv[] = array(128, 'ax', 'b88000');
		$rv[] = array(255, 'ax', 'b8ff00');
		$rv[] = array(256, 'ax', 'b80001');
		$rv[] = array(0xff, 'ax', 'b8ff00');
		$rv[] = array(0x102, 'ax', 'b80201');
		$rv[] = array(1024, 'ax', 'b80004');
		$rv[] = array(1024 + 127, 'ax', 'b87f04');
		$rv[] = array(0xfffe, 'ax', 'b8feff');
		$rv[] = array(0xffff, 'ax', 'b8ffff');
		$rv[] = array(0x10000, 'ax', 'b80000');
		
		
		$rv[] = array(0, 'cl', 'b100');
		$rv[] = array(127, 'cl', 'b17f');
		$rv[] = array(128, 'cl', 'b180');
		$rv[] = array(255, 'cl', 'b1ff');
		$rv[] = array(256, 'cl', 'b100');
		$rv[] = array(0xff, 'cl', 'b1ff');
		$rv[] = array(0x102, 'cl', 'b102');
		$rv[] = array(1024, 'cl', 'b100');
		
		$rv[] = array(0, 'ch', 'b500');
		$rv[] = array(127, 'ch', 'b57f');
		$rv[] = array(128, 'ch', 'b580');
		$rv[] = array(255, 'ch', 'b5ff');
		$rv[] = array(256, 'ch', 'b500');
		$rv[] = array(0xff, 'ch', 'b5ff');
		$rv[] = array(0x102, 'ch', 'b502');
		$rv[] = array(1024, 'ch', 'b500');
		$rv[] = array(1024 + 127, 'ch', 'b57f');
		
		$rv[] = array(0, 'cx', 'b90000');
		$rv[] = array(127, 'cx', 'b97f00');
		$rv[] = array(128, 'cx', 'b98000');
		$rv[] = array(255, 'cx', 'b9ff00');
		$rv[] = array(256, 'cx', 'b90001');
		$rv[] = array(0xff, 'cx', 'b9ff00');
		$rv[] = array(0x102, 'cx', 'b90201');
		$rv[] = array(1024, 'cx', 'b90004');
		$rv[] = array(1024 + 127, 'cx', 'b97f04');
		$rv[] = array(0xfffe, 'cx', 'b9feff');
		$rv[] = array(0xffff, 'cx', 'b9ffff');
		$rv[] = array(0x10000, 'cx', 'b90000');
		
		
		$rv[] = array(0, 'dl', 'b200');
		$rv[] = array(127, 'dl', 'b27f');
		$rv[] = array(128, 'dl', 'b280');
		$rv[] = array(255, 'dl', 'b2ff');
		$rv[] = array(256, 'dl', 'b200');
		$rv[] = array(0xff, 'dl', 'b2ff');
		$rv[] = array(0x102, 'dl', 'b202');
		$rv[] = array(1024, 'dl', 'b200');
		
		$rv[] = array(0, 'dh', 'b600');
		$rv[] = array(127, 'dh', 'b67f');
		$rv[] = array(128, 'dh', 'b680');
		$rv[] = array(255, 'dh', 'b6ff');
		$rv[] = array(256, 'dh', 'b600');
		$rv[] = array(0xff, 'dh', 'b6ff');
		$rv[] = array(0x102, 'dh', 'b602');
		$rv[] = array(1024, 'dh', 'b600');
		$rv[] = array(1024 + 127, 'dh', 'b67f');
		
		$rv[] = array(0, 'dx', 'ba0000');
		$rv[] = array(127, 'dx', 'ba7f00');
		$rv[] = array(128, 'dx', 'ba8000');
		$rv[] = array(255, 'dx', 'baff00');
		$rv[] = array(256, 'dx', 'ba0001');
		$rv[] = array(0xff, 'dx', 'baff00');
		$rv[] = array(0x102, 'dx', 'ba0201');
		$rv[] = array(1024, 'dx', 'ba0004');
		$rv[] = array(1024 + 127, 'dx', 'ba7f04');
		$rv[] = array(0xfffe, 'dx', 'bafeff');
		$rv[] = array(0xffff, 'dx', 'baffff');
		$rv[] = array(0x10000, 'dx', 'ba0000');
		
		
		$rv[] = array(0, 'bl', 'b300');
		$rv[] = array(127, 'bl', 'b37f');
		$rv[] = array(128, 'bl', 'b380');
		$rv[] = array(255, 'bl', 'b3ff');
		$rv[] = array(256, 'bl', 'b300');
		$rv[] = array(0xff, 'bl', 'b3ff');
		$rv[] = array(0x102, 'bl', 'b302');
		$rv[] = array(1024, 'bl', 'b300');
		
		$rv[] = array(0, 'bh', 'b700');
		$rv[] = array(127, 'bh', 'b77f');
		$rv[] = array(128, 'bh', 'b780');
		$rv[] = array(255, 'bh', 'b7ff');
		$rv[] = array(256, 'bh', 'b700');
		$rv[] = array(0xff, 'bh', 'b7ff');
		$rv[] = array(0x102, 'bh', 'b702');
		$rv[] = array(1024, 'bh', 'b700');
		$rv[] = array(1024 + 127, 'bh', 'b77f');
		
		$rv[] = array(0, 'bx', 'bb0000');
		$rv[] = array(127, 'bx', 'bb7f00');
		$rv[] = array(128, 'bx', 'bb8000');
		$rv[] = array(255, 'bx', 'bbff00');
		$rv[] = array(256, 'bx', 'bb0001');
		$rv[] = array(0xff, 'bx', 'bbff00');
		$rv[] = array(0x102, 'bx', 'bb0201');
		$rv[] = array(1024, 'bx', 'bb0004');
		$rv[] = array(1024 + 127, 'bx', 'bb7f04');
		$rv[] = array(0xfffe, 'bx', 'bbfeff');
		$rv[] = array(0xffff, 'bx', 'bbffff');
		$rv[] = array(0x10000, 'bx', 'bb0000');
		
		
		$rv[] = array('al', 'al', '88c0');
		$rv[] = array('al', 'cl', '88c1');
		$rv[] = array('al', 'dl', '88c2');
		$rv[] = array('al', 'bl', '88c3');
		$rv[] = array('al', 'ah', '88c4');
		$rv[] = array('al', 'ch', '88c5');
		$rv[] = array('al', 'dh', '88c6');
		$rv[] = array('al', 'bh', '88c7');
		
		$rv[] = array('cl', 'al', '88c8');
		$rv[] = array('cl', 'cl', '88c9');
		$rv[] = array('cl', 'dl', '88ca');
		$rv[] = array('cl', 'bl', '88cb');
		$rv[] = array('cl', 'ah', '88cc');
		$rv[] = array('cl', 'ch', '88cd');
		$rv[] = array('cl', 'dh', '88ce');
		$rv[] = array('cl', 'bh', '88cf');
		
		$rv[] = array('dl', 'al', '88d0');
		$rv[] = array('dl', 'cl', '88d1');
		$rv[] = array('dl', 'dl', '88d2');
		$rv[] = array('dl', 'bl', '88d3');
		$rv[] = array('dl', 'ah', '88d4');
		$rv[] = array('dl', 'ch', '88d5');
		$rv[] = array('dl', 'dh', '88d6');
		$rv[] = array('dl', 'bh', '88d7');
		
		$rv[] = array('bl', 'al', '88d8');
		$rv[] = array('bl', 'cl', '88d9');
		$rv[] = array('bl', 'dl', '88da');
		$rv[] = array('bl', 'bl', '88db');
		$rv[] = array('bl', 'ah', '88dc');
		$rv[] = array('bl', 'ch', '88dd');
		$rv[] = array('bl', 'dh', '88de');
		$rv[] = array('bl', 'bh', '88df');
		
		
		$rv[] = array('ah', 'al', '88e0');
		$rv[] = array('ah', 'cl', '88e1');
		$rv[] = array('ah', 'dl', '88e2');
		$rv[] = array('ah', 'bl', '88e3');
		$rv[] = array('ah', 'ah', '88e4');
		$rv[] = array('ah', 'ch', '88e5');
		$rv[] = array('ah', 'dh', '88e6');
		$rv[] = array('ah', 'bh', '88e7');
		
		$rv[] = array('ch', 'al', '88e8');
		$rv[] = array('ch', 'cl', '88e9');
		$rv[] = array('ch', 'dl', '88ea');
		$rv[] = array('ch', 'bl', '88eb');
		$rv[] = array('ch', 'ah', '88ec');
		$rv[] = array('ch', 'ch', '88ed');
		$rv[] = array('ch', 'dh', '88ee');
		$rv[] = array('ch', 'bh', '88ef');
		
		$rv[] = array('dh', 'al', '88f0');
		$rv[] = array('dh', 'cl', '88f1');
		$rv[] = array('dh', 'dl', '88f2');
		$rv[] = array('dh', 'bl', '88f3');
		$rv[] = array('dh', 'ah', '88f4');
		$rv[] = array('dh', 'ch', '88f5');
		$rv[] = array('dh', 'dh', '88f6');
		$rv[] = array('dh', 'bh', '88f7');
		
		$rv[] = array('bh', 'al', '88f8');
		$rv[] = array('bh', 'cl', '88f9');
		$rv[] = array('bh', 'dl', '88fa');
		$rv[] = array('bh', 'bl', '88fb');
		$rv[] = array('bh', 'ah', '88fc');
		$rv[] = array('bh', 'ch', '88fd');
		$rv[] = array('bh', 'dh', '88fe');
		$rv[] = array('bh', 'bh', '88ff');
		
		
		return $rv;
	}
	
	/**
	 * @dataProvider testX86Provider
	 */
	public function testX86($src, $dst, $expected){
		$instr = new X86Mov($src, $dst);
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function testI386Provider(){
		$rv = array();
		
		#$rv[] = array('al', 'al', 'b000');
		
		return $rv;
	}
	
	/**
	 * @dataProvider testI386Provider
	 */
	#public function testI386(){
		
	#}
	
	/*public function testX8664(){
		
	}
	*/
}

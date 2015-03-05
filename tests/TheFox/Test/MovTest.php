<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

#use TheFox\Assembly\Instruction\X86\Mov as X86Mov;
#use TheFox\Assembly\Instruction\I386\Mov as I386Mov;
#use TheFox\Assembly\Instruction\X86_64\Mov as X8664Mov;

class MovTest extends PHPUnit_Framework_TestCase{
	
	public function basicTest($instr, $expected){
		$opcode = unpack('H*', $instr->assemble());
		$opcode = $opcode[1];
		$this->assertEquals($expected, $opcode);
	}
	
	public function basicProvider(){
		$rv = array();
		
		# TODO
		$rv[] = array('', '', '');
		#$rv[] = array(0, 'XYZ', '');
		#$rv[] = array('XYZ', 0, '');
		#$rv[] = array('XYZ', 'XYZ', '');
		#$rv[] = array('XYZ', 'al', '');
		
		# TODO
		#$rv[] = array('ax', 'ebx', '');
		#$rv[] = array('ebx', 'ax', '');
		#$rv[] = array('ax', 'rbx', '');
		#$rv[] = array('rbx', 'ax', '');
		#$rv[] = array('eax', 'rbx', '');
		#$rv[] = array('rbx', 'eax', '');
		
		return $rv;
	}
	
	public function bit8ValueToRegisterProvider(){
		$rv = array();
		
		// A
		$rv[] = array(0, 'al', 'b000');
		$rv[] = array(0x7f, 'al', 'b07f');
		$rv[] = array(0x80, 'al', 'b080');
		$rv[] = array(0xff, 'al', 'b0ff');
		$rv[] = array(0x100, 'al', 'b000');
		$rv[] = array(0x102, 'al', 'b002');
		$rv[] = array(0x400, 'al', 'b000');
		
		$rv[] = array(0, 'ah', 'b400');
		$rv[] = array(0x7f, 'ah', 'b47f');
		$rv[] = array(0x80, 'ah', 'b480');
		$rv[] = array(0xff, 'ah', 'b4ff');
		$rv[] = array(0x100, 'ah', 'b400');
		$rv[] = array(0x102, 'ah', 'b402');
		$rv[] = array(0x400, 'ah', 'b400');
		$rv[] = array(0x47f, 'ah', 'b47f');
		
		// C
		$rv[] = array(0, 'cl', 'b100');
		$rv[] = array(0x7f, 'cl', 'b17f');
		$rv[] = array(0x80, 'cl', 'b180');
		$rv[] = array(0xff, 'cl', 'b1ff');
		$rv[] = array(0x100, 'cl', 'b100');
		$rv[] = array(0x102, 'cl', 'b102');
		$rv[] = array(0x400, 'cl', 'b100');
		
		$rv[] = array(0, 'ch', 'b500');
		$rv[] = array(0x7f, 'ch', 'b57f');
		$rv[] = array(0x80, 'ch', 'b580');
		$rv[] = array(0xff, 'ch', 'b5ff');
		$rv[] = array(0x100, 'ch', 'b500');
		$rv[] = array(0x102, 'ch', 'b502');
		$rv[] = array(0x400, 'ch', 'b500');
		$rv[] = array(0x47f, 'ch', 'b57f');
		
		// D
		$rv[] = array(0, 'dl', 'b200');
		$rv[] = array(0x7f, 'dl', 'b27f');
		$rv[] = array(0x80, 'dl', 'b280');
		$rv[] = array(0xff, 'dl', 'b2ff');
		$rv[] = array(0x100, 'dl', 'b200');
		$rv[] = array(0x102, 'dl', 'b202');
		$rv[] = array(0x400, 'dl', 'b200');
		
		$rv[] = array(0, 'dh', 'b600');
		$rv[] = array(0x7f, 'dh', 'b67f');
		$rv[] = array(0x80, 'dh', 'b680');
		$rv[] = array(0xff, 'dh', 'b6ff');
		$rv[] = array(0x100, 'dh', 'b600');
		$rv[] = array(0x102, 'dh', 'b602');
		$rv[] = array(0x400, 'dh', 'b600');
		$rv[] = array(0x47f, 'dh', 'b67f');
		
		// B
		$rv[] = array(0, 'bl', 'b300');
		$rv[] = array(0x7f, 'bl', 'b37f');
		$rv[] = array(0x80, 'bl', 'b380');
		$rv[] = array(0xff, 'bl', 'b3ff');
		$rv[] = array(0x100, 'bl', 'b300');
		$rv[] = array(0x102, 'bl', 'b302');
		$rv[] = array(0x400, 'bl', 'b300');
		
		$rv[] = array(0, 'bh', 'b700');
		$rv[] = array(0x7f, 'bh', 'b77f');
		$rv[] = array(0x80, 'bh', 'b780');
		$rv[] = array(0xff, 'bh', 'b7ff');
		$rv[] = array(0x100, 'bh', 'b700');
		$rv[] = array(0x102, 'bh', 'b702');
		$rv[] = array(0x400, 'bh', 'b700');
		$rv[] = array(0x47f, 'bh', 'b77f');
		
		return $rv;
	}
	
	public function bit8RegisterToRegisterProvider(){
		$rv = array();
		
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
	
	public function bit8IsValidRegisterSizeProvider(){
		$rv = array();
		
		$rv[] = array('al', 'al', true);
		$rv[] = array('al', 'bl', true);
		$rv[] = array('al', 'ah', true);
		$rv[] = array('bl', 'ah', true);
		$rv[] = array('ah', 'al', true);
		
		return $rv;
	}
	
	public function bit16ValueToRegisterProvider(){
		$rv = array();
		
		$rv[] = array(0, 'ax', 'b80000');
		$rv[] = array(0x7f, 'ax', 'b87f00');
		$rv[] = array(0x80, 'ax', 'b88000');
		$rv[] = array(0xff, 'ax', 'b8ff00');
		$rv[] = array(0x100, 'ax', 'b80001');
		$rv[] = array(0x102, 'ax', 'b80201');
		$rv[] = array(0x400, 'ax', 'b80004');
		$rv[] = array(0x47f, 'ax', 'b87f04');
		$rv[] = array(0xfffe, 'ax', 'b8feff');
		$rv[] = array(0xffff, 'ax', 'b8ffff');
		$rv[] = array(0x10000, 'ax', 'b80000');
		
		$rv[] = array(0, 'cx', 'b90000');
		$rv[] = array(0x7f, 'cx', 'b97f00');
		$rv[] = array(0x80, 'cx', 'b98000');
		$rv[] = array(0xff, 'cx', 'b9ff00');
		$rv[] = array(0x100, 'cx', 'b90001');
		$rv[] = array(0x102, 'cx', 'b90201');
		$rv[] = array(0x400, 'cx', 'b90004');
		$rv[] = array(0x47f, 'cx', 'b97f04');
		$rv[] = array(0xfffe, 'cx', 'b9feff');
		$rv[] = array(0xffff, 'cx', 'b9ffff');
		$rv[] = array(0x10000, 'cx', 'b90000');
		
		$rv[] = array(0, 'dx', 'ba0000');
		$rv[] = array(0x7f, 'dx', 'ba7f00');
		$rv[] = array(0x80, 'dx', 'ba8000');
		$rv[] = array(0xff, 'dx', 'baff00');
		$rv[] = array(0x100, 'dx', 'ba0001');
		$rv[] = array(0x102, 'dx', 'ba0201');
		$rv[] = array(0x400, 'dx', 'ba0004');
		$rv[] = array(0x47f, 'dx', 'ba7f04');
		$rv[] = array(0xfffe, 'dx', 'bafeff');
		$rv[] = array(0xffff, 'dx', 'baffff');
		$rv[] = array(0x10000, 'dx', 'ba0000');
		
		$rv[] = array(0, 'bx', 'bb0000');
		$rv[] = array(0x7f, 'bx', 'bb7f00');
		$rv[] = array(0x80, 'bx', 'bb8000');
		$rv[] = array(0xff, 'bx', 'bbff00');
		$rv[] = array(0x100, 'bx', 'bb0001');
		$rv[] = array(0x102, 'bx', 'bb0201');
		$rv[] = array(0x400, 'bx', 'bb0004');
		$rv[] = array(0x47f, 'bx', 'bb7f04');
		$rv[] = array(0xfffe, 'bx', 'bbfeff');
		$rv[] = array(0xffff, 'bx', 'bbffff');
		$rv[] = array(0x10000, 'bx', 'bb0000');
		
		return $rv;
	}
	
	public function bit16RegisterToRegisterProvider(){
		$rv = array();
		
		$rv[] = array('ax', 'ax', '89c0');
		$rv[] = array('ax', 'cx', '89c1');
		$rv[] = array('ax', 'dx', '89c2');
		$rv[] = array('ax', 'bx', '89c3');
		
		$rv[] = array('cx', 'ax', '89c8');
		$rv[] = array('cx', 'cx', '89c9');
		$rv[] = array('cx', 'dx', '89ca');
		$rv[] = array('cx', 'bx', '89cb');
		
		$rv[] = array('dx', 'ax', '89d0');
		$rv[] = array('dx', 'cx', '89d1');
		$rv[] = array('dx', 'dx', '89d2');
		$rv[] = array('dx', 'bx', '89d3');
		
		$rv[] = array('bx', 'ax', '89d8');
		$rv[] = array('bx', 'cx', '89d9');
		$rv[] = array('bx', 'dx', '89da');
		$rv[] = array('bx', 'bx', '89db');
		
		return $rv;
	}
	
	public function bit16IsValidRegisterSizeProvider(){
		$rv = array();
		
		$rv[] = array('ax', 'ax', true);
		$rv[] = array('ax', 'bx', true);
		
		$rv[] = array('ax', 'al', false);
		$rv[] = array('ax', 'ah', false);
		$rv[] = array('ax', 'bl', false);
		$rv[] = array('ax', 'bh', false);
		$rv[] = array('al', 'ax', false);
		$rv[] = array('ah', 'ax', false);
		
		return $rv;
	}
	
	public function bit32ValueToRegisterProvider(){
		$rv = array();
		
		$rv[] = array(0, 'eax', 'b800000000');
		$rv[] = array(0x7f, 'eax', 'b87f000000');
		$rv[] = array(0x80, 'eax', 'b880000000');
		$rv[] = array(0xff, 'eax', 'b8ff000000');
		$rv[] = array(0x100, 'eax', 'b800010000');
		$rv[] = array(0x102, 'eax', 'b802010000');
		$rv[] = array(0x400, 'eax', 'b800040000');
		$rv[] = array(0x47f, 'eax', 'b87f040000');
		$rv[] = array(0xfffe, 'eax', 'b8feff0000');
		$rv[] = array(0xffff, 'eax', 'b8ffff0000');
		$rv[] = array(0x10000, 'eax', 'b800000100');
		$rv[] = array(0x12345678, 'eax', 'b878563412');
		$rv[] = array(0xffffffff, 'eax', 'b8ffffffff');
		$rv[] = array(0xff12345678, 'eax', 'b878563412');
		
		$rv[] = array(0, 'ecx', 'b900000000');
		$rv[] = array(0x7f, 'ecx', 'b97f000000');
		$rv[] = array(0x80, 'ecx', 'b980000000');
		$rv[] = array(0xff, 'ecx', 'b9ff000000');
		$rv[] = array(0x100, 'ecx', 'b900010000');
		$rv[] = array(0x102, 'ecx', 'b902010000');
		$rv[] = array(0x400, 'ecx', 'b900040000');
		$rv[] = array(0x47f, 'ecx', 'b97f040000');
		$rv[] = array(0xfffe, 'ecx', 'b9feff0000');
		$rv[] = array(0xffff, 'ecx', 'b9ffff0000');
		$rv[] = array(0x10000, 'ecx', 'b900000100');
		$rv[] = array(0x12345678, 'ecx', 'b978563412');
		$rv[] = array(0xffffffff, 'ecx', 'b9ffffffff');
		$rv[] = array(0xff12345678, 'ecx', 'b978563412');
		
		$rv[] = array(0, 'edx', 'ba00000000');
		$rv[] = array(0x7f, 'edx', 'ba7f000000');
		$rv[] = array(0x80, 'edx', 'ba80000000');
		$rv[] = array(0xff, 'edx', 'baff000000');
		$rv[] = array(0x100, 'edx', 'ba00010000');
		$rv[] = array(0x102, 'edx', 'ba02010000');
		$rv[] = array(0x400, 'edx', 'ba00040000');
		$rv[] = array(0x47f, 'edx', 'ba7f040000');
		$rv[] = array(0xfffe, 'edx', 'bafeff0000');
		$rv[] = array(0xffff, 'edx', 'baffff0000');
		$rv[] = array(0x10000, 'edx', 'ba00000100');
		$rv[] = array(0x12345678, 'edx', 'ba78563412');
		$rv[] = array(0xffffffff, 'edx', 'baffffffff');
		$rv[] = array(0xff12345678, 'edx', 'ba78563412');
		
		$rv[] = array(0, 'ebx', 'bb00000000');
		$rv[] = array(0x7f, 'ebx', 'bb7f000000');
		$rv[] = array(0x80, 'ebx', 'bb80000000');
		$rv[] = array(0xff, 'ebx', 'bbff000000');
		$rv[] = array(0x100, 'ebx', 'bb00010000');
		$rv[] = array(0x102, 'ebx', 'bb02010000');
		$rv[] = array(0x400, 'ebx', 'bb00040000');
		$rv[] = array(0x47f, 'ebx', 'bb7f040000');
		$rv[] = array(0xfffe, 'ebx', 'bbfeff0000');
		$rv[] = array(0xffff, 'ebx', 'bbffff0000');
		$rv[] = array(0x10000, 'ebx', 'bb00000100');
		$rv[] = array(0x12345678, 'ebx', 'bb78563412');
		$rv[] = array(0xffffffff, 'ebx', 'bbffffffff');
		$rv[] = array(0xff12345678, 'ebx', 'bb78563412');
		
		return $rv;
	}
	
	public function bit32RegisterToRegisterProvider(){
		$rv = array();
		
		$rv[] = array('eax', 'eax', '89c0');
		$rv[] = array('eax', 'ecx', '89c1');
		$rv[] = array('eax', 'edx', '89c2');
		$rv[] = array('eax', 'ebx', '89c3');
		
		$rv[] = array('ecx', 'eax', '89c8');
		$rv[] = array('ecx', 'ecx', '89c9');
		$rv[] = array('ecx', 'edx', '89ca');
		$rv[] = array('ecx', 'ebx', '89cb');
		
		$rv[] = array('edx', 'eax', '89d0');
		$rv[] = array('edx', 'ecx', '89d1');
		$rv[] = array('edx', 'edx', '89d2');
		$rv[] = array('edx', 'ebx', '89d3');
		
		$rv[] = array('ebx', 'eax', '89d8');
		$rv[] = array('ebx', 'ecx', '89d9');
		$rv[] = array('ebx', 'edx', '89da');
		$rv[] = array('ebx', 'ebx', '89db');
		
		return $rv;
	}
	
	public function bit32IsValidRegisterSizeProvider(){
		$rv = array();
		
		$rv[] = array('eax', 'eax', true);
		$rv[] = array('eax', 'ebx', true);
		
		$rv[] = array('eax', 'al', false);
		$rv[] = array('eax', 'ah', false);
		$rv[] = array('eax', 'bl', false);
		$rv[] = array('eax', 'bh', false);
		$rv[] = array('al', 'eax', false);
		$rv[] = array('ah', 'eax', false);
		
		$rv[] = array('eax', 'ax', false);
		$rv[] = array('eax', 'bx', false);
		$rv[] = array('ax', 'eax', false);
		
		return $rv;
	}
	
	public function bit64ValueToRegisterProvider(){
		$rv = array();
		
		$rv[] = array(0, 'rax', '48c7c000000000');
		#$rv[] = array(0x7f, 'rax', '');
		#$rv[] = array(0x80, 'rax', '');
		#$rv[] = array(0xff, 'rax', '');
		#$rv[] = array(0x100, 'rax', '');
		#$rv[] = array(0x102, 'rax', '');
		#$rv[] = array(0x400, 'rax', '');
		#$rv[] = array(0x47f, 'rax', '');
		#$rv[] = array(0xfffe, 'rax', '');
		#$rv[] = array(0xffff, 'rax', '');
		#$rv[] = array(0x10000, 'rax', '');
		#$rv[] = array(0x12345678, 'rax', '48c7c078563412');
		#$rv[] = array(0xffffffff, 'rax', '48c7c078563412');
		#$rv[] = array(0x123456789abcdefe, 'rax', '48b8fedebc9a78563412');
		#$rv[] = array(0xffffffffffffffff, 'rax', '48b8fedebc9a78563412');
		
		/*
		$rv[] = array(0, 'rcx', '48c7c1');
		$rv[] = array(0x7f, 'rcx', '48c7c1');
		$rv[] = array(0x80, 'rcx', '48c7c1');
		$rv[] = array(0xff, 'rcx', '48c7c1');
		$rv[] = array(0x100, 'rcx', '48c7c1');
		$rv[] = array(0x102, 'rcx', '48c7c1');
		$rv[] = array(0x400, 'rcx', '48c7c1');
		$rv[] = array(0x47f, 'rcx', '48c7c1');
		$rv[] = array(0xfffe, 'rcx', '48c7c1');
		$rv[] = array(0xffff, 'rcx', '48c7c1');
		$rv[] = array(0x10000, 'rcx', '48c7c1');
		$rv[] = array(0x12345678, 'rcx', '48c7c1');
		$rv[] = array(0xffffffff, 'rcx', '48c7c1');
		$rv[] = array(0x123456789abcdefe, 'rcx', '48c7c1');
		$rv[] = array(0xffffffffffffffff, 'rcx', '48c7c1');
		
		$rv[] = array(0, 'rdx', '48c7c2');
		$rv[] = array(0x7f, 'rdx', '48c7c2');
		$rv[] = array(0x80, 'rdx', '48c7c2');
		$rv[] = array(0xff, 'rdx', '48c7c2');
		$rv[] = array(0x100, 'rdx', '48c7c2');
		$rv[] = array(0x102, 'rdx', '48c7c2');
		$rv[] = array(0x400, 'rdx', '48c7c2');
		$rv[] = array(0x47f, 'rdx', '48c7c2');
		$rv[] = array(0xfffe, 'rdx', '48c7c2');
		$rv[] = array(0xffff, 'rdx', '48c7c2');
		$rv[] = array(0x10000, 'rdx', '48c7c2');
		$rv[] = array(0x12345678, 'rdx', '48c7c2');
		$rv[] = array(0xffffffff, 'rdx', '48c7c2');
		$rv[] = array(0x123456789abcdefe, 'rdx', '48c7c2');
		$rv[] = array(0xffffffffffffffff, 'rdx', '48c7c2');
		
		$rv[] = array(0, 'rbx', '48c7c3');
		$rv[] = array(0x7f, 'rbx', '48c7c3');
		$rv[] = array(0x80, 'rbx', '48c7c3');
		$rv[] = array(0xff, 'rbx', '48c7c3');
		$rv[] = array(0x100, 'rbx', '48c7c3');
		$rv[] = array(0x102, 'rbx', '48c7c3');
		$rv[] = array(0x400, 'rbx', '48c7c3');
		$rv[] = array(0x47f, 'rbx', '48c7c3');
		$rv[] = array(0xfffe, 'rbx', '48c7c3');
		$rv[] = array(0xffff, 'rbx', '48c7c3');
		$rv[] = array(0x10000, 'rbx', '48c7c3');
		$rv[] = array(0x12345678, 'rbx', '48c7c3');
		$rv[] = array(0xffffffff, 'rbx', '48c7c3');
		$rv[] = array(0x123456789abcdefe, 'rbx', '48c7c3');
		$rv[] = array(0xffffffffffffffff, 'rbx', '48c7c3');
		*/
		
		return $rv;
	}
	
	public function bit64RegisterToRegisterProvider(){
		$rv = array();
		
		$rv[] = array('rax', 'rax', '4889c0');
		$rv[] = array('rax', 'rcx', '4889c1');
		$rv[] = array('rax', 'rdx', '4889c2');
		$rv[] = array('rax', 'rbx', '4889c3');
		
		$rv[] = array('rcx', 'rax', '4889c8');
		$rv[] = array('rcx', 'rcx', '4889c9');
		$rv[] = array('rcx', 'rdx', '4889ca');
		$rv[] = array('rcx', 'rbx', '4889cb');
		
		$rv[] = array('rdx', 'rax', '4889d0');
		$rv[] = array('rdx', 'rcx', '4889d1');
		$rv[] = array('rdx', 'rdx', '4889d2');
		$rv[] = array('rdx', 'rbx', '4889d3');
		
		$rv[] = array('rbx', 'rax', '4889d8');
		$rv[] = array('rbx', 'rcx', '4889d9');
		$rv[] = array('rbx', 'rdx', '4889da');
		
		return $rv;
	}
	
	public function bit64IsValidRegisterSizeProvider(){
		$rv = array();
		
		$rv[] = array('rax', 'rax', true);
		$rv[] = array('rax', 'rbx', true);
		
		$rv[] = array('rax', 'al', false);
		$rv[] = array('rax', 'ah', false);
		$rv[] = array('rax', 'bl', false);
		$rv[] = array('rax', 'bh', false);
		$rv[] = array('al', 'rax', false);
		$rv[] = array('ah', 'rax', false);
		
		$rv[] = array('rax', 'ax', false);
		$rv[] = array('rax', 'bx', false);
		$rv[] = array('ax', 'rax', false);
		
		$rv[] = array('rax', 'eax', false);
		$rv[] = array('rax', 'ebx', false);
		$rv[] = array('eax', 'rax', false);
		
		return $rv;
	}
	
}

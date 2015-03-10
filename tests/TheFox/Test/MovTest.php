<?php

namespace TheFox\Test;

class MovTest extends BasicTestCase{
	
	public function basicProvider(){
		$rv = array();
		
		$rv[] = array('', '', '', 0);
		/*$rv[] = array(0, 'XYZ', '', 0);
		$rv[] = array('XYZ', 0, '', 0);
		$rv[] = array('XYZ', 'XYZ', '', 0);
		$rv[] = array('XYZ', 'al', '', 0);*/
		
		return $rv;
	}
	
	public function bit8ValueToRegisterProvider(){
		$rv = array();
		
		// A
		$rv[] = array(0, 'al', 'b000', 2);
		$rv[] = array(0x7f, 'al', 'b07f', 2);
		$rv[] = array(0x80, 'al', 'b080', 2);
		$rv[] = array(0xff, 'al', 'b0ff', 2);
		$rv[] = array(0x100, 'al', 'b000', 2);
		$rv[] = array(0x102, 'al', 'b002', 2);
		$rv[] = array(0x400, 'al', 'b000', 2);
		
		$rv[] = array(0, 'ah', 'b400', 2);
		$rv[] = array(0x7f, 'ah', 'b47f', 2);
		$rv[] = array(0x80, 'ah', 'b480', 2);
		$rv[] = array(0xff, 'ah', 'b4ff', 2);
		$rv[] = array(0x100, 'ah', 'b400', 2);
		$rv[] = array(0x102, 'ah', 'b402', 2);
		$rv[] = array(0x400, 'ah', 'b400', 2);
		$rv[] = array(0x47f, 'ah', 'b47f', 2);
		
		// C
		$rv[] = array(0, 'cl', 'b100', 2);
		$rv[] = array(0x7f, 'cl', 'b17f', 2);
		$rv[] = array(0x80, 'cl', 'b180', 2);
		$rv[] = array(0xff, 'cl', 'b1ff', 2);
		$rv[] = array(0x100, 'cl', 'b100', 2);
		$rv[] = array(0x102, 'cl', 'b102', 2);
		$rv[] = array(0x400, 'cl', 'b100', 2);
		
		$rv[] = array(0, 'ch', 'b500', 2);
		$rv[] = array(0x7f, 'ch', 'b57f', 2);
		$rv[] = array(0x80, 'ch', 'b580', 2);
		$rv[] = array(0xff, 'ch', 'b5ff', 2);
		$rv[] = array(0x100, 'ch', 'b500', 2);
		$rv[] = array(0x102, 'ch', 'b502', 2);
		$rv[] = array(0x400, 'ch', 'b500', 2);
		$rv[] = array(0x47f, 'ch', 'b57f', 2);
		
		// D
		$rv[] = array(0, 'dl', 'b200', 2);
		$rv[] = array(0x7f, 'dl', 'b27f', 2);
		$rv[] = array(0x80, 'dl', 'b280', 2);
		$rv[] = array(0xff, 'dl', 'b2ff', 2);
		$rv[] = array(0x100, 'dl', 'b200', 2);
		$rv[] = array(0x102, 'dl', 'b202', 2);
		$rv[] = array(0x400, 'dl', 'b200', 2);
		
		$rv[] = array(0, 'dh', 'b600', 2);
		$rv[] = array(0x7f, 'dh', 'b67f', 2);
		$rv[] = array(0x80, 'dh', 'b680', 2);
		$rv[] = array(0xff, 'dh', 'b6ff', 2);
		$rv[] = array(0x100, 'dh', 'b600', 2);
		$rv[] = array(0x102, 'dh', 'b602', 2);
		$rv[] = array(0x400, 'dh', 'b600', 2);
		$rv[] = array(0x47f, 'dh', 'b67f', 2);
		
		// B
		$rv[] = array(0, 'bl', 'b300', 2);
		$rv[] = array(0x7f, 'bl', 'b37f', 2);
		$rv[] = array(0x80, 'bl', 'b380', 2);
		$rv[] = array(0xff, 'bl', 'b3ff', 2);
		$rv[] = array(0x100, 'bl', 'b300', 2);
		$rv[] = array(0x102, 'bl', 'b302', 2);
		$rv[] = array(0x400, 'bl', 'b300', 2);
		
		$rv[] = array(0, 'bh', 'b700', 2);
		$rv[] = array(0x7f, 'bh', 'b77f', 2);
		$rv[] = array(0x80, 'bh', 'b780', 2);
		$rv[] = array(0xff, 'bh', 'b7ff', 2);
		$rv[] = array(0x100, 'bh', 'b700', 2);
		$rv[] = array(0x102, 'bh', 'b702', 2);
		$rv[] = array(0x400, 'bh', 'b700', 2);
		$rv[] = array(0x47f, 'bh', 'b77f', 2);
		
		return $rv;
	}
	
	public function bit8RegisterToRegisterProvider(){
		$rv = array();
		
		$rv[] = array('al', 'al', '88c0', 2);
		$rv[] = array('al', 'cl', '88c1', 2);
		$rv[] = array('al', 'dl', '88c2', 2);
		$rv[] = array('al', 'bl', '88c3', 2);
		$rv[] = array('al', 'ah', '88c4', 2);
		$rv[] = array('al', 'ch', '88c5', 2);
		$rv[] = array('al', 'dh', '88c6', 2);
		$rv[] = array('al', 'bh', '88c7', 2);
		
		$rv[] = array('cl', 'al', '88c8', 2);
		$rv[] = array('cl', 'cl', '88c9', 2);
		$rv[] = array('cl', 'dl', '88ca', 2);
		$rv[] = array('cl', 'bl', '88cb', 2);
		$rv[] = array('cl', 'ah', '88cc', 2);
		$rv[] = array('cl', 'ch', '88cd', 2);
		$rv[] = array('cl', 'dh', '88ce', 2);
		$rv[] = array('cl', 'bh', '88cf', 2);
		
		$rv[] = array('dl', 'al', '88d0', 2);
		$rv[] = array('dl', 'cl', '88d1', 2);
		$rv[] = array('dl', 'dl', '88d2', 2);
		$rv[] = array('dl', 'bl', '88d3', 2);
		$rv[] = array('dl', 'ah', '88d4', 2);
		$rv[] = array('dl', 'ch', '88d5', 2);
		$rv[] = array('dl', 'dh', '88d6', 2);
		$rv[] = array('dl', 'bh', '88d7', 2);
		
		$rv[] = array('bl', 'al', '88d8', 2);
		$rv[] = array('bl', 'cl', '88d9', 2);
		$rv[] = array('bl', 'dl', '88da', 2);
		$rv[] = array('bl', 'bl', '88db', 2);
		$rv[] = array('bl', 'ah', '88dc', 2);
		$rv[] = array('bl', 'ch', '88dd', 2);
		$rv[] = array('bl', 'dh', '88de', 2);
		$rv[] = array('bl', 'bh', '88df', 2);
		
		
		$rv[] = array('ah', 'al', '88e0', 2);
		$rv[] = array('ah', 'cl', '88e1', 2);
		$rv[] = array('ah', 'dl', '88e2', 2);
		$rv[] = array('ah', 'bl', '88e3', 2);
		$rv[] = array('ah', 'ah', '88e4', 2);
		$rv[] = array('ah', 'ch', '88e5', 2);
		$rv[] = array('ah', 'dh', '88e6', 2);
		$rv[] = array('ah', 'bh', '88e7', 2);
		
		$rv[] = array('ch', 'al', '88e8', 2);
		$rv[] = array('ch', 'cl', '88e9', 2);
		$rv[] = array('ch', 'dl', '88ea', 2);
		$rv[] = array('ch', 'bl', '88eb', 2);
		$rv[] = array('ch', 'ah', '88ec', 2);
		$rv[] = array('ch', 'ch', '88ed', 2);
		$rv[] = array('ch', 'dh', '88ee', 2);
		$rv[] = array('ch', 'bh', '88ef', 2);
		
		$rv[] = array('dh', 'al', '88f0', 2);
		$rv[] = array('dh', 'cl', '88f1', 2);
		$rv[] = array('dh', 'dl', '88f2', 2);
		$rv[] = array('dh', 'bl', '88f3', 2);
		$rv[] = array('dh', 'ah', '88f4', 2);
		$rv[] = array('dh', 'ch', '88f5', 2);
		$rv[] = array('dh', 'dh', '88f6', 2);
		$rv[] = array('dh', 'bh', '88f7', 2);
		
		$rv[] = array('bh', 'al', '88f8', 2);
		$rv[] = array('bh', 'cl', '88f9', 2);
		$rv[] = array('bh', 'dl', '88fa', 2);
		$rv[] = array('bh', 'bl', '88fb', 2);
		$rv[] = array('bh', 'ah', '88fc', 2);
		$rv[] = array('bh', 'ch', '88fd', 2);
		$rv[] = array('bh', 'dh', '88fe', 2);
		$rv[] = array('bh', 'bh', '88ff', 2);
		
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
		
		$rv[] = array(0, 'ax', 'b80000', 3);
		$rv[] = array(0x7f, 'ax', 'b87f00', 3);
		$rv[] = array(0x80, 'ax', 'b88000', 3);
		$rv[] = array(0xff, 'ax', 'b8ff00', 3);
		$rv[] = array(0x100, 'ax', 'b80001', 3);
		$rv[] = array(0x102, 'ax', 'b80201', 3);
		$rv[] = array(0x400, 'ax', 'b80004', 3);
		$rv[] = array(0x47f, 'ax', 'b87f04', 3);
		$rv[] = array(0xfffe, 'ax', 'b8feff', 3);
		$rv[] = array(0xffff, 'ax', 'b8ffff', 3);
		$rv[] = array(0x10000, 'ax', 'b80000', 3);
		
		$rv[] = array(0, 'cx', 'b90000', 3);
		$rv[] = array(0x7f, 'cx', 'b97f00', 3);
		$rv[] = array(0x80, 'cx', 'b98000', 3);
		$rv[] = array(0xff, 'cx', 'b9ff00', 3);
		$rv[] = array(0x100, 'cx', 'b90001', 3);
		$rv[] = array(0x102, 'cx', 'b90201', 3);
		$rv[] = array(0x400, 'cx', 'b90004', 3);
		$rv[] = array(0x47f, 'cx', 'b97f04', 3);
		$rv[] = array(0xfffe, 'cx', 'b9feff', 3);
		$rv[] = array(0xffff, 'cx', 'b9ffff', 3);
		$rv[] = array(0x10000, 'cx', 'b90000', 3);
		
		$rv[] = array(0, 'dx', 'ba0000', 3);
		$rv[] = array(0x7f, 'dx', 'ba7f00', 3);
		$rv[] = array(0x80, 'dx', 'ba8000', 3);
		$rv[] = array(0xff, 'dx', 'baff00', 3);
		$rv[] = array(0x100, 'dx', 'ba0001', 3);
		$rv[] = array(0x102, 'dx', 'ba0201', 3);
		$rv[] = array(0x400, 'dx', 'ba0004', 3);
		$rv[] = array(0x47f, 'dx', 'ba7f04', 3);
		$rv[] = array(0xfffe, 'dx', 'bafeff', 3);
		$rv[] = array(0xffff, 'dx', 'baffff', 3);
		$rv[] = array(0x10000, 'dx', 'ba0000', 3);
		
		$rv[] = array(0, 'bx', 'bb0000', 3);
		$rv[] = array(0x7f, 'bx', 'bb7f00', 3);
		$rv[] = array(0x80, 'bx', 'bb8000', 3);
		$rv[] = array(0xff, 'bx', 'bbff00', 3);
		$rv[] = array(0x100, 'bx', 'bb0001', 3);
		$rv[] = array(0x102, 'bx', 'bb0201', 3);
		$rv[] = array(0x400, 'bx', 'bb0004', 3);
		$rv[] = array(0x47f, 'bx', 'bb7f04', 3);
		$rv[] = array(0xfffe, 'bx', 'bbfeff', 3);
		$rv[] = array(0xffff, 'bx', 'bbffff', 3);
		$rv[] = array(0x10000, 'bx', 'bb0000', 3);
		
		return $rv;
	}
	
	public function bit16RegisterToRegisterProvider(){
		$rv = array();
		
		$rv[] = array('ax', 'ax', '89c0', 2);
		$rv[] = array('ax', 'cx', '89c1', 2);
		$rv[] = array('ax', 'dx', '89c2', 2);
		$rv[] = array('ax', 'bx', '89c3', 2);
		
		$rv[] = array('cx', 'ax', '89c8', 2);
		$rv[] = array('cx', 'cx', '89c9', 2);
		$rv[] = array('cx', 'dx', '89ca', 2);
		$rv[] = array('cx', 'bx', '89cb', 2);
		
		$rv[] = array('dx', 'ax', '89d0', 2);
		$rv[] = array('dx', 'cx', '89d1', 2);
		$rv[] = array('dx', 'dx', '89d2', 2);
		$rv[] = array('dx', 'bx', '89d3', 2);
		
		$rv[] = array('bx', 'ax', '89d8', 2);
		$rv[] = array('bx', 'cx', '89d9', 2);
		$rv[] = array('bx', 'dx', '89da', 2);
		$rv[] = array('bx', 'bx', '89db', 2);
		
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
		
		$rv[] = array(0, 'eax', 'b800000000', 5);
		$rv[] = array(0x7f, 'eax', 'b87f000000', 5);
		$rv[] = array(0x80, 'eax', 'b880000000', 5);
		$rv[] = array(0xff, 'eax', 'b8ff000000', 5);
		$rv[] = array(0x100, 'eax', 'b800010000', 5);
		$rv[] = array(0x102, 'eax', 'b802010000', 5);
		$rv[] = array(0x400, 'eax', 'b800040000', 5);
		$rv[] = array(0x47f, 'eax', 'b87f040000', 5);
		$rv[] = array(0xfffe, 'eax', 'b8feff0000', 5);
		$rv[] = array(0xffff, 'eax', 'b8ffff0000', 5);
		$rv[] = array(0x10000, 'eax', 'b800000100', 5);
		$rv[] = array(0x12345678, 'eax', 'b878563412', 5);
		$rv[] = array(0x7fffffff, 'eax', 'b8ffffff7f', 5);
		$rv[] = array(0x80000000, 'eax', 'b800000080', 5);
		$rv[] = array(0x80000001, 'eax', 'b801000080', 5);
		$rv[] = array(0xffffffff, 'eax', 'b8ffffffff', 5);
		$rv[] = array(0xff12345678, 'eax', 'b878563412', 5);
		
		$rv[] = array(0, 'ecx', 'b900000000', 5);
		$rv[] = array(0x7f, 'ecx', 'b97f000000', 5);
		$rv[] = array(0x80, 'ecx', 'b980000000', 5);
		$rv[] = array(0xff, 'ecx', 'b9ff000000', 5);
		$rv[] = array(0x100, 'ecx', 'b900010000', 5);
		$rv[] = array(0x102, 'ecx', 'b902010000', 5);
		$rv[] = array(0x400, 'ecx', 'b900040000', 5);
		$rv[] = array(0x47f, 'ecx', 'b97f040000', 5);
		$rv[] = array(0xfffe, 'ecx', 'b9feff0000', 5);
		$rv[] = array(0xffff, 'ecx', 'b9ffff0000', 5);
		$rv[] = array(0x10000, 'ecx', 'b900000100', 5);
		$rv[] = array(0x12345678, 'ecx', 'b978563412', 5);
		$rv[] = array(0x7fffffff, 'ecx', 'b9ffffff7f', 5);
		$rv[] = array(0x80000000, 'ecx', 'b900000080', 5);
		$rv[] = array(0x80000001, 'ecx', 'b901000080', 5);
		$rv[] = array(0xffffffff, 'ecx', 'b9ffffffff', 5);
		$rv[] = array(0xff12345678, 'ecx', 'b978563412', 5);
		
		$rv[] = array(0, 'edx', 'ba00000000', 5);
		$rv[] = array(0x7f, 'edx', 'ba7f000000', 5);
		$rv[] = array(0x80, 'edx', 'ba80000000', 5);
		$rv[] = array(0xff, 'edx', 'baff000000', 5);
		$rv[] = array(0x100, 'edx', 'ba00010000', 5);
		$rv[] = array(0x102, 'edx', 'ba02010000', 5);
		$rv[] = array(0x400, 'edx', 'ba00040000', 5);
		$rv[] = array(0x47f, 'edx', 'ba7f040000', 5);
		$rv[] = array(0xfffe, 'edx', 'bafeff0000', 5);
		$rv[] = array(0xffff, 'edx', 'baffff0000', 5);
		$rv[] = array(0x10000, 'edx', 'ba00000100', 5);
		$rv[] = array(0x12345678, 'edx', 'ba78563412', 5);
		$rv[] = array(0x7fffffff, 'edx', 'baffffff7f', 5);
		$rv[] = array(0x80000000, 'edx', 'ba00000080', 5);
		$rv[] = array(0x80000001, 'edx', 'ba01000080', 5);
		$rv[] = array(0xffffffff, 'edx', 'baffffffff', 5);
		$rv[] = array(0xff12345678, 'edx', 'ba78563412', 5);
		
		$rv[] = array(0, 'ebx', 'bb00000000', 5);
		$rv[] = array(0x7f, 'ebx', 'bb7f000000', 5);
		$rv[] = array(0x80, 'ebx', 'bb80000000', 5);
		$rv[] = array(0xff, 'ebx', 'bbff000000', 5);
		$rv[] = array(0x100, 'ebx', 'bb00010000', 5);
		$rv[] = array(0x102, 'ebx', 'bb02010000', 5);
		$rv[] = array(0x400, 'ebx', 'bb00040000', 5);
		$rv[] = array(0x47f, 'ebx', 'bb7f040000', 5);
		$rv[] = array(0xfffe, 'ebx', 'bbfeff0000', 5);
		$rv[] = array(0xffff, 'ebx', 'bbffff0000', 5);
		$rv[] = array(0x10000, 'ebx', 'bb00000100', 5);
		$rv[] = array(0x12345678, 'ebx', 'bb78563412', 5);
		$rv[] = array(0x7fffffff, 'ebx', 'bbffffff7f', 5);
		$rv[] = array(0x80000000, 'ebx', 'bb00000080', 5);
		$rv[] = array(0x80000001, 'ebx', 'bb01000080', 5);
		$rv[] = array(0xffffffff, 'ebx', 'bbffffffff', 5);
		$rv[] = array(0xff12345678, 'ebx', 'bb78563412', 5);
		
		return $rv;
	}
	
	public function bit32RegisterToRegisterProvider(){
		$rv = array();
		
		$rv[] = array('eax', 'eax', '89c0', 2);
		$rv[] = array('eax', 'ecx', '89c1', 2);
		$rv[] = array('eax', 'edx', '89c2', 2);
		$rv[] = array('eax', 'ebx', '89c3', 2);
		
		$rv[] = array('ecx', 'eax', '89c8', 2);
		$rv[] = array('ecx', 'ecx', '89c9', 2);
		$rv[] = array('ecx', 'edx', '89ca', 2);
		$rv[] = array('ecx', 'ebx', '89cb', 2);
		
		$rv[] = array('edx', 'eax', '89d0', 2);
		$rv[] = array('edx', 'ecx', '89d1', 2);
		$rv[] = array('edx', 'edx', '89d2', 2);
		$rv[] = array('edx', 'ebx', '89d3', 2);
		
		$rv[] = array('ebx', 'eax', '89d8', 2);
		$rv[] = array('ebx', 'ecx', '89d9', 2);
		$rv[] = array('ebx', 'edx', '89da', 2);
		$rv[] = array('ebx', 'ebx', '89db', 2);
		
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
		
		$rv[] = array(0, 'rax', '48c7c000000000', 7);
		$rv[] = array(0x7f, 'rax', '48c7c07f000000', 7);
		$rv[] = array(0x80, 'rax', '48c7c080000000', 7);
		$rv[] = array(0xff, 'rax', '48c7c0ff000000', 7);
		$rv[] = array(0x100, 'rax', '48c7c000010000', 7);
		$rv[] = array(0x102, 'rax', '48c7c002010000', 7);
		$rv[] = array(0x400, 'rax', '48c7c000040000', 7);
		$rv[] = array(0x47f, 'rax', '48c7c07f040000', 7);
		$rv[] = array(0x1000, 'rax', '48c7c000100000', 7);
		$rv[] = array(0xfffe, 'rax', '48c7c0feff0000', 7);
		$rv[] = array(0xffff, 'rax', '48c7c0ffff0000', 7);
		$rv[] = array(0x10000, 'rax', '48c7c000000100', 7);
		$rv[] = array(0x12345678, 'rax', '48c7c078563412', 7);
		$rv[] = array(0x7ffffffd, 'rax', '48c7c0fdffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xfffd, 'rax', '48c7c0fdffff7f', 7);
		$rv[] = array(0x7fffffff, 'rax', '48c7c0ffffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xffff, 'rax', '48c7c0ffffff7f', 7);
		$rv[] = array(0x80000000, 'rax', '48b80000008000000000', 10);
		$rv[] = array(0x80000001, 'rax', '48b80100008000000000', 10);
		$rv[] = array(0xffffffff, 'rax', '48b8ffffffff00000000', 10);
		$rv[] = array(0x123456789abcdefe, 'rax', '48b8fedebc9a78563412', 10);
		$rv[] = array(0x7fffffff00000000, 'rax', '48b800000000ffffff7f', 10);
		$rv[] = array((0x80000000 << 32), 'rax', '48b80000000000000080', 10);
		$rv[] = array((0xffffffff << 32) | 0xffffffff, 'rax', '48b8ffffffffffffffff', 10);
		
		$rv[] = array(0, 'rcx', '48c7c100000000', 7);
		$rv[] = array(0x7f, 'rcx', '48c7c17f000000', 7);
		$rv[] = array(0x80, 'rcx', '48c7c180000000', 7);
		$rv[] = array(0xff, 'rcx', '48c7c1ff000000', 7);
		$rv[] = array(0x100, 'rcx', '48c7c100010000', 7);
		$rv[] = array(0x102, 'rcx', '48c7c102010000', 7);
		$rv[] = array(0x400, 'rcx', '48c7c100040000', 7);
		$rv[] = array(0x47f, 'rcx', '48c7c17f040000', 7);
		$rv[] = array(0x1000, 'rcx', '48c7c100100000', 7);
		$rv[] = array(0xfffe, 'rcx', '48c7c1feff0000', 7);
		$rv[] = array(0xffff, 'rcx', '48c7c1ffff0000', 7);
		$rv[] = array(0x10000, 'rcx', '48c7c100000100', 7);
		$rv[] = array(0x12345678, 'rcx', '48c7c178563412', 7);
		$rv[] = array(0x7ffffffd, 'rcx', '48c7c1fdffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xfffd, 'rcx', '48c7c1fdffff7f', 7);
		$rv[] = array(0x7fffffff, 'rcx', '48c7c1ffffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xffff, 'rcx', '48c7c1ffffff7f', 7);
		$rv[] = array(0x80000000, 'rcx', '48b90000008000000000', 10);
		$rv[] = array(0x80000001, 'rcx', '48b90100008000000000', 10);
		$rv[] = array(0xffffffff, 'rcx', '48b9ffffffff00000000', 10);
		$rv[] = array(0x123456789abcdefe, 'rcx', '48b9fedebc9a78563412', 10);
		$rv[] = array(0x7fffffff00000000, 'rcx', '48b900000000ffffff7f', 10);
		$rv[] = array((0x80000000 << 32), 'rcx', '48b90000000000000080', 10);
		$rv[] = array((0xffffffff << 32) | 0xffffffff, 'rcx', '48b9ffffffffffffffff', 10);
		
		$rv[] = array(0, 'rdx', '48c7c200000000', 7);
		$rv[] = array(0x7f, 'rdx', '48c7c27f000000', 7);
		$rv[] = array(0x80, 'rdx', '48c7c280000000', 7);
		$rv[] = array(0xff, 'rdx', '48c7c2ff000000', 7);
		$rv[] = array(0x100, 'rdx', '48c7c200010000', 7);
		$rv[] = array(0x102, 'rdx', '48c7c202010000', 7);
		$rv[] = array(0x400, 'rdx', '48c7c200040000', 7);
		$rv[] = array(0x47f, 'rdx', '48c7c27f040000', 7);
		$rv[] = array(0x1000, 'rdx', '48c7c200100000', 7);
		$rv[] = array(0xfffe, 'rdx', '48c7c2feff0000', 7);
		$rv[] = array(0xffff, 'rdx', '48c7c2ffff0000', 7);
		$rv[] = array(0x10000, 'rdx', '48c7c200000100', 7);
		$rv[] = array(0x12345678, 'rdx', '48c7c278563412', 7);
		$rv[] = array(0x7ffffffd, 'rdx', '48c7c2fdffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xfffd, 'rdx', '48c7c2fdffff7f', 7);
		$rv[] = array(0x7fffffff, 'rdx', '48c7c2ffffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xffff, 'rdx', '48c7c2ffffff7f', 7);
		$rv[] = array(0x80000000, 'rdx', '48ba0000008000000000', 10);
		$rv[] = array(0x80000001, 'rdx', '48ba0100008000000000', 10);
		$rv[] = array(0xffffffff, 'rdx', '48baffffffff00000000', 10);
		$rv[] = array(0x123456789abcdefe, 'rdx', '48bafedebc9a78563412', 10);
		$rv[] = array(0x7fffffff00000000, 'rdx', '48ba00000000ffffff7f', 10);
		$rv[] = array((0x80000000 << 32), 'rdx', '48ba0000000000000080', 10);
		$rv[] = array((0xffffffff << 32) | 0xffffffff, 'rdx', '48baffffffffffffffff', 10);
		
		$rv[] = array(0, 'rbx', '48c7c300000000', 7);
		$rv[] = array(0x7f, 'rbx', '48c7c37f000000', 7);
		$rv[] = array(0x80, 'rbx', '48c7c380000000', 7);
		$rv[] = array(0xff, 'rbx', '48c7c3ff000000', 7);
		$rv[] = array(0x100, 'rbx', '48c7c300010000', 7);
		$rv[] = array(0x102, 'rbx', '48c7c302010000', 7);
		$rv[] = array(0x400, 'rbx', '48c7c300040000', 7);
		$rv[] = array(0x47f, 'rbx', '48c7c37f040000', 7);
		$rv[] = array(0x1000, 'rbx', '48c7c300100000', 7);
		$rv[] = array(0xfffe, 'rbx', '48c7c3feff0000', 7);
		$rv[] = array(0xffff, 'rbx', '48c7c3ffff0000', 7);
		$rv[] = array(0x10000, 'rbx', '48c7c300000100', 7);
		$rv[] = array(0x12345678, 'rbx', '48c7c378563412', 7);
		$rv[] = array(0x7ffffffd, 'rbx', '48c7c3fdffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xfffd, 'rbx', '48c7c3fdffff7f', 7);
		$rv[] = array(0x7fffffff, 'rbx', '48c7c3ffffff7f', 7);
		$rv[] = array((0x7fff << 16) | 0xffff, 'rbx', '48c7c3ffffff7f', 7);
		$rv[] = array(0x80000000, 'rbx', '48bb0000008000000000', 10);
		$rv[] = array(0x80000001, 'rbx', '48bb0100008000000000', 10);
		$rv[] = array(0xffffffff, 'rbx', '48bbffffffff00000000', 10);
		$rv[] = array(0x123456789abcdefe, 'rbx', '48bbfedebc9a78563412', 10);
		$rv[] = array(0x7fffffff00000000, 'rbx', '48bb00000000ffffff7f', 10);
		$rv[] = array((0x80000000 << 32), 'rbx', '48bb0000000000000080', 10);
		$rv[] = array((0xffffffff << 32) | 0xffffffff, 'rbx', '48bbffffffffffffffff', 10);
		
		return $rv;
	}
	
	public function bit64RegisterToRegisterProvider(){
		$rv = array();
		
		$rv[] = array('rax', 'rax', '4889c0', 3);
		$rv[] = array('rax', 'rcx', '4889c1', 3);
		$rv[] = array('rax', 'rdx', '4889c2', 3);
		$rv[] = array('rax', 'rbx', '4889c3', 3);
		
		$rv[] = array('rcx', 'rax', '4889c8', 3);
		$rv[] = array('rcx', 'rcx', '4889c9', 3);
		$rv[] = array('rcx', 'rdx', '4889ca', 3);
		$rv[] = array('rcx', 'rbx', '4889cb', 3);
		
		$rv[] = array('rdx', 'rax', '4889d0', 3);
		$rv[] = array('rdx', 'rcx', '4889d1', 3);
		$rv[] = array('rdx', 'rdx', '4889d2', 3);
		$rv[] = array('rdx', 'rbx', '4889d3', 3);
		
		$rv[] = array('rbx', 'rax', '4889d8', 3);
		$rv[] = array('rbx', 'rcx', '4889d9', 3);
		$rv[] = array('rbx', 'rdx', '4889da', 3);
		
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

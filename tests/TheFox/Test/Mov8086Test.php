<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Mov as X86Mov;

class Mov8086Test extends MovTest{
	
	/**
	 * @dataProvider basicProvider
	 */
	public function test8086Basic($src, $dst, $expected){
		$this->basicTest(new X86Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8ValueToRegisterProvider
	 */
	public function test8086Bit8ValueToRegister($src, $dst, $expected){
		$this->basicTest(new X86Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8RegisterToRegisterProvider
	 */
	public function test8086Bit8RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new X86Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit16ValueToRegisterProvider
	 */
	public function test8086Bit16ValueToRegister($src, $dst, $expected){
		$this->basicTest(new X86Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit16RegisterToRegisterProvider
	 */
	public function test8086Bit16RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new X86Mov($src, $dst), $expected);
	}
	
}

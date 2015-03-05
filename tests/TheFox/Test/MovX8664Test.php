<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Instruction\X86_64\Mov;

class MovX8664Test extends MovTest{
	
	/**
	 * @dataProvider basicProvider
	 */
	public function testX8664Basic($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8ValueToRegisterProvider
	 */
	public function testX8664Bit8ValueToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8RegisterToRegisterProvider
	 */
	public function testX8664Bit8RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit16ValueToRegisterProvider
	 */
	public function testX8664Bit16ValueToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), '66'.$expected);
	}
	
	/**
	 * @dataProvider bit16RegisterToRegisterProvider
	 */
	public function testX8664Bit16RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), '66'.$expected);
	}
	
	/**
	 * @dataProvider bit32ValueToRegisterProvider
	 */
	public function testX8664Bit32ValueToRegister($src, $dst, $expected){
		#$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit32RegisterToRegisterProvider
	 */
	public function testX8664Bit32RegisterToRegister($src, $dst, $expected){
		#$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit64ValueToRegisterProvider
	 */
	public function testX8664Bit64ValueToRegister($src, $dst, $expected){
		#$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit64RegisterToRegisterProvider
	 */
	public function testX8664Bit64RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8IsValidRegisterSizeProvider
	 */
	public function testX8664Bit8IsValidRegisterSize($src, $dst, $expected){
		$instr = new Mov($src, $dst);
		$this->assertEquals($expected, $instr->isValidRegisterSize());
	}
	
	/**
	 * @dataProvider bit16IsValidRegisterSizeProvider
	 */
	public function testX8664Bit16IsValidRegisterSize($src, $dst, $expected){
		$instr = new Mov($src, $dst);
		$this->assertEquals($expected, $instr->isValidRegisterSize());
	}
	
	/**
	 * @dataProvider bit32IsValidRegisterSizeProvider
	 */
	public function testX8664Bit32IsValidRegisterSize($src, $dst, $expected){
		$instr = new Mov($src, $dst);
		$this->assertEquals($expected, $instr->isValidRegisterSize());
	}
	
	/**
	 * @dataProvider bit64IsValidRegisterSizeProvider
	 */
	public function testX8664Bit64IsValidRegisterSize($src, $dst, $expected){
		$instr = new Mov($src, $dst);
		$this->assertEquals($expected, $instr->isValidRegisterSize());
	}
	
}

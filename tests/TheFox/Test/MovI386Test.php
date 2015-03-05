<?php

namespace TheFox\Test;

use PHPUnit_Framework_TestCase;

use TheFox\Assembly\Instruction\I386\Mov;

class MovI386Test extends MovTest{
	
	/**
	 * @dataProvider basicProvider
	 */
	public function testI386Basic($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8ValueToRegisterProvider
	 */
	public function testI386Bit8ValueToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8RegisterToRegisterProvider
	 */
	public function testI386Bit8RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit16ValueToRegisterProvider
	 */
	public function testI386Bit16ValueToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), '66'.$expected);
	}
	
	/**
	 * @dataProvider bit16RegisterToRegisterProvider
	 */
	public function testI386Bit16RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), '66'.$expected);
	}
	
	/**
	 * @dataProvider bit32ValueToRegisterProvider
	 */
	public function testI386Bit32ValueToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit32RegisterToRegisterProvider
	 */
	public function testI386Bit32RegisterToRegister($src, $dst, $expected){
		$this->basicTest(new Mov($src, $dst), $expected);
	}
	
	/**
	 * @dataProvider bit8IsValidRegisterSizeProvider
	 */
	public function testI386Bit8IsValidRegisterSize($src, $dst, $expected){
		$instr = new Mov($src, $dst);
		$this->assertEquals($expected, $instr->isValidRegisterSize());
	}
	
	/**
	 * @dataProvider bit16IsValidRegisterSizeProvider
	 */
	public function testI386Bit16IsValidRegisterSize($src, $dst, $expected){
		$instr = new Mov($src, $dst);
		$this->assertEquals($expected, $instr->isValidRegisterSize());
	}
	
}

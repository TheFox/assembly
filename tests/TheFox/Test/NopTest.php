<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Nop as X8086Nop;
use TheFox\Assembly\Instruction\I386\Nop as I386Nop;
use TheFox\Assembly\Instruction\X86_64\Nop as X8664Nop;

class NopTest extends BasicTestCase{
	
	public function test8086(){
		$this->basicTest(new X8086Nop(), '90');
	}
	
	public function testI386(){
		$this->basicTest(new I386Nop(), '90');
	}
	
	public function testX8664(){
		$this->basicTest(new X8664Nop(), '90');
	}
	
}

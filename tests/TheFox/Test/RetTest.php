<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Ret as X8086Ret;
use TheFox\Assembly\Instruction\I386\Ret as I386Ret;
use TheFox\Assembly\Instruction\X86_64\Ret as X8664Ret;

class RetTest extends BasicTestCase{
	
	public function test8086(){
		$this->basicTest(new X8086Ret(), 'c3', 1);
	}
	
	public function testI386(){
		$this->basicTest(new I386Ret(), 'c3', 1);
	}
	
	public function testX8664(){
		$this->basicTest(new X8664Ret(), 'c3', 1);
	}
	
}

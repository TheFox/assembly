<?php

namespace TheFox\Assembly;

class Assembly{
	
	const NAME = 'Assembly';
	const VERSION = '0.2.0-dev';
	const RELEASE = 1;
	
	private $instructions = array();
	
	public function __construct(){
		
	}
	
	public function addInstruction(Instruction $instruction){
		$this->instructions[] = $instruction;
	}
	
	public function assemble(){
		$opcodes = '';
		foreach($this->instructions as $instrId => $instruction){
			$opcodes .= $instruction->assemble();
		}
		return $opcodes;
	}
	
}

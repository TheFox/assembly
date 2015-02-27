<?php

namespace TheFox\Assembly;

class Instruction{
	
	private $opcode = '';
	
	public function setOpcode($opcode){
		$this->opcode = $opcode;
	}
	
	public function getOpcode(){
		return $this->opcode;
	}
	
	public function assemble(){
		return $this->opcode;
	}
	
}

<?php

namespace TheFox\Assembly;

class Assembly{
	
	const NAME = 'Assembly';
	const VERSION = '0.4.0-dev.1';
	
	private $instructionId = 0;
	private $instructions = array();
	private $offset = 0;
	
	public function addInstruction(Instruction $instr){
		$this->instructions[$this->instructionId] = $instr;
		
		$instr->setId($this->instructionId);
		$instr->setAssembly($this);
		$instr->setOffset($this->offset);
		$this->offset += $instr->getLen();
		
		$this->instructionId++;
	}
	
	public function updateInstructionLen(Instruction $instr, $newLen){
		$lenOffset = $newLen - $instr->getLen();
		
		$this->offset += $lenOffset;
		
		for($instrId = $instr->getId() + 1; $instrId < $this->instructionId; $instrId++){
			if(isset($this->instructions[$instrId])){
				$fInstr = $this->instructions[$instrId];
				$fInstr->addOffset($lenOffset);
			}
		}
	}
	
	public function assemble(){
		$opcodes = '';
		foreach($this->instructions as $instrId => $instr){
			$opcodes .= $instr->assemble();
		}
		return $opcodes;
	}
	
}

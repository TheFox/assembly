<?php

namespace TheFox\Assembly;

class Assembly{
	
	const NAME = 'Assembly';
	const VERSION = '0.3.0';
	const RELEASE = 3;
	
	private $instructionId = 0;
	private $instructions = array();
	private $offset = 0;
	
	public function __construct(){
		
	}
	
	public function addInstruction(Instruction $instr){
		$this->instructions[$this->instructionId] = $instr;
		
		$instr->setId($this->instructionId);
		$instr->setAssembly($this);
		$instr->setOffset($this->offset);
		$this->offset += $instr->getLen();
		
		$this->instructionId++;
	}
	
	/*public function addOffset($offset){
		$this->offset += $offset;
	}*/
	
	public function updateInstructionLen(Instruction $instr, $newLen){
		#print 'updateInstructionLen'."\n";
		
		$lenOffset = $newLen - $instr->getLen();
		#print "\t".'lenOffset: '.$lenOffset."\n";
		
		#print "\t".'offset old: '.$this->offset."\n";
		$this->offset += $lenOffset;
		#print "\t".'offset new: '.$this->offset."\n";
		
		for($instrId = $instr->getId() + 1; $instrId < $this->instructionId; $instrId++){
			if(isset($this->instructions[$instrId])){
				$fInstr = $this->instructions[$instrId];
				#$oos = $fInstr->getOffset();
				$fInstr->addOffset($lenOffset);
				
				#print "\t".'instr '.$instrId.': '.$oos.' -> '.$fInstr->getOffset()."\n";
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

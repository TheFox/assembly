<?php

namespace TheFox\Assembly;

class Instruction{
	
	private $id;
	private $assembly;
	private $offset = 0;
	private $opcode = '';
	private $len = 0;
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setAssembly(Assembly $assembly){
		$this->assembly = $assembly;
	}
	
	public function getAssembly(){
		return $this->assembly;
	}
	
	public function setOffset($offset){
		$this->offset = $offset;
	}
	
	public function addOffset($offset){
		$this->offset += $offset;
	}
	
	public function getOffset(){
		return $this->offset;
	}
	
	public function setOpcode($opcode){
		$this->opcode = $opcode;
	}
	
	public function getOpcode(){
		return $this->opcode;
	}
	
	public function setLen($len){
		if($this->getAssembly()){
			$this->getAssembly()->updateInstructionLen($this, $len);
		}
		$this->len = $len;
	}
	
	public function getLen(){
		return $this->len;
	}
	
	public function assemble(){
		return $this->opcode;
	}
	
}

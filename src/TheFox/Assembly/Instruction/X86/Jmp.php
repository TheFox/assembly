<?php

// http://www.mathemainzel.info/files/x86asmref.html#jmp

namespace TheFox\Assembly\Instruction\X86;

use TheFox\Assembly\Instruction as BaseInstruction;

class Jmp extends Instruction{
	
	public $dst;
	
	public function __construct($dst){
		$this->dst = $dst;
	}
	
	public function assemble(){
		if($this->dst instanceof Instruction){
			#\Doctrine\Common\Util\Debug::dump($this->dst);
			print 'is instruction'."\n";
			
		}
		elseif(is_numeric($this->dst)){
			$dst = $this->dst;
			print 'is numeric: '.$dst.' '.dechex($dst)."\n";
			
			$base = 0;
			#$absDst = abs($dst);
			if($dst >= -0x80 && $dst <= 0x7f){
				$base = 0xEB;
				$dst &= 0xff;
				$dst = dechex($dst);
				$dst = sprintf('%02s', $dst);
				print "\t".'short label: '.$dst."\n";
			}
			
			if($base){
				$opcode = dechex($base).$dst;
				$opcodeLen = strlen($opcode);
				
				$this->setOpcode(pack('H*', $opcode));
				$this->setLen($opcodeLen / 2);
			}
		}
		
		return $this->getOpcode();
	}
	
}

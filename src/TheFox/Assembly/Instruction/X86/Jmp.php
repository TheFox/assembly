<?php

// http://www.mathemainzel.info/files/x86asmref.html#jmp

namespace TheFox\Assembly\Instruction\X86;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction;

class Jmp extends Instruction{
	
	public $dst;
	
	public function __construct($dst){
		$this->dst = $dst;
	}
	
	public function assemble(){
		$dst = $this->dst;
		
		if($dst instanceof Instruction){
			$offset = $dst->getOffset() - $this->getOffset();
			#print "\t".'offset: '.$offset."\n";
			
			$orgOffset = $offset;
			$offset -= 2;
			if($orgOffset < 0){
				if($offset < -0x80){
					$offset--;
				}
				#print "\t".'<- '.$offset."\n";
			}
			
			$jmp = new Jmp($offset);
			$this->setOpcode($jmp->assemble());
			$this->setLen($jmp->getLen());
		}
		elseif(is_numeric($dst)){
			#print 'is numeric: '.$dst.' '.dechex($dst)."\n";
			
			$base = 0;
			#$absDst = abs($dst);
			if($dst >= -0x80 && $dst <= 0x7f){
				$base = 0xEB00;
				$dst &= 0xff;
				$dst |= $base;
				
				#print "\t".'short label: '.dechex($dst)."\n";
			}
			elseif($dst >= -0x8000 && $dst <= 0x7fff){
				$base = 0xE90000;
				$dst &= 0xffff;
				
				$dst = Num::be2le($dst, 2);
				$dst |= $base;
				
				#print "\t".'long label: '.dechex($dst)."\n";
			}
			
			if($base){
				$opcode = dechex($dst);
				$opcodeLen = strlen($opcode);
				
				$this->setOpcode(pack('H*', $opcode));
				$this->setLen($opcodeLen / 2);
			}
		}
		
		return $this->getOpcode();
	}
	
}

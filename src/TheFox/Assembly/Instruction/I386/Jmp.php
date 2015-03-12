<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction;
use TheFox\Assembly\Instruction\X86\Jmp as X86Jmp;

class Jmp extends X86Jmp{
	
	public function assemble(){
		#print 'jmp assemble'."\n";
		$dst = $this->dst;
		
		if($dst instanceof Instruction){
			#\Doctrine\Common\Util\Debug::dump($dst, 1);
			#\Doctrine\Common\Util\Debug::dump($this, 1);
			
			#print "\t".'dst offset:  '.$dst->getOffset()."\n";
			#print "\t".'this offset: '.$this->getOffset()."\n";
			
			$offset = $dst->getOffset() - $this->getOffset();
			#print "\t".'diff: '.$offset."\n";
			
			$orgOffset = $offset;
			$offset -= 2;
			if($orgOffset < 0){
				if($offset < -0x80){
					$offset -= 3;
				}
				#print "\t".'<- '.$offset."\n";
			}
			
			$jmp = new Jmp($offset);
			$this->setOpcode($jmp->assemble());
			$this->setLen($jmp->getLen());
		}
		elseif(is_numeric($dst)){
			#print "\t".'is numeric: '.$dst.' '.dechex($dst)."\n";
			
			$base = 0;
			#$absDst = abs($dst);
			if($dst >= -0x80 && $dst <= 0x7f){
				$base = 0xEB00;
				$dst &= 0xff;
				$dst |= $base;
				
				#print "\t".'short label: '.dechex($dst)."\n";
			}
			elseif($dst >= -0x80000000 && $dst <= 0x7fffffff){
				$base = 0xE900000000;
				$dst &= 0xffffffff;
				
				$dst = Num::be2le($dst, 4);
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

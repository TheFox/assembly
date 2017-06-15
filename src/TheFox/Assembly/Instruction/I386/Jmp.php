<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction;
use TheFox\Assembly\Instruction\X86\Jmp as X86Jmp;

class Jmp extends X86Jmp
{
    public function assemble(): string
    {
        $dst = $this->dst;
        $isStrDst = is_string($dst);

        if ($dst instanceof Instruction) {
            $offset = $dst->getOffset() - $this->getOffset();

            $orgOffset = $offset;
            $offset -= 2;
            if ($orgOffset < 0) {
                if ($offset < -0x80) {
                    $offset -= 3;
                }
            }

            $jmp = new Jmp($offset);
            $this->setOpcode($jmp->assemble());
            $this->setLen($jmp->getLen());
        } elseif (is_numeric($dst)) {
            $base = 0;
            if ($dst >= -0x80 && $dst <= 0x7f) {
                $base = 0xEB00;
                $dst &= 0xff;
                $dst |= $base;
            } elseif ($dst >= -0x80000000 && $dst <= 0x7fffffff) {
                $base = 0xE900000000;
                $dst &= 0xffffffff;

                $dst = Num::be2le($dst, 4);
                $dst |= $base;
            }

            if ($base) {
                $opcode = dechex($dst);
                $opcodeLen = strlen($opcode);

                $this->setOpcode(pack('H*', $opcode));
                $this->setLen($opcodeLen / 2);
            }
        } elseif ($isStrDst) {
            $strLenDst = strlen($dst);

            if ($strLenDst == 2) {
                $jmp = new X86Jmp($dst);
                $this->setOpcode(pack('H*', '66') . $jmp->assemble());
                $this->setLen($jmp->getLen() + 1);
            } elseif ($strLenDst == 3) {
                $base = 0xFFE0;
                switch ($dst[1]) {
                    /*case 'a':
                        $base += 0;
                        break;*/
                    case 'c':
                        $base++;
                        break;
                    case 'd':
                        $base += 2;
                        break;
                    case 'b':
                        $base += 3;
                        break;
                }

                $opcode = dechex($base);
                $opcodeLen = strlen($opcode);

                $this->setOpcode(pack('H*', $opcode));
                $this->setLen($opcodeLen / 2);
            }
        }

        return $this->getOpcode();
    }
}

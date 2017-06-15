<?php

namespace TheFox\Assembly\Instruction\X86_64;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction\X86\Mov as X86Mov;
use TheFox\Assembly\Instruction\I386\Mov as I386Mov;

class Mov extends I386Mov
{
    /**
     * Mov constructor.
     * @param string $src
     * @param string $dst
     */
    public function __construct(string $src, string $dst)
    {
        $this->src = strtolower($src);
        $this->dst = strtolower($dst);

        $lenSrc = strlen($this->src);
        $isNumSrc = is_numeric($this->src);
        $isStrSrc = is_string($this->src);

        $lenDst = strlen($this->dst);
        $isStrDst = is_string($this->dst);

        if ($isNumSrc && $isStrDst && $lenDst == 2) {
            parent::__construct($this->src, $this->dst);
        } elseif ($isNumSrc && $isStrDst && $lenDst == 3) {
            $base = 0;

            switch ($dst[0]) {
                case 'e':
                    $this->src &= 0xffffffff;
                    $base = 0xB8;

                    $this->src = Num::be2le($this->src, 4);
                    $this->src = dechex($this->src);

                    $this->src = sprintf('%08s', $this->src);

                    break;
                case 'r':
                    $srcHigh = ($this->src >> 32) & 0xffffffff;
                    $srcLow = $this->src & 0xffffffff;

                    if ($this->src > 0x7fffffff | $srcHigh) {
                        $base = 0x48B8;
                        $this->src = Num::be2le($this->src, 8);
                        $this->src = dechex($this->src);
                        $this->src = sprintf('%016s', $this->src);
                    } else {
                        $base = 0x48C7C0;
                        $this->src = $srcLow;

                        $this->src = Num::be2le($this->src, 4);
                        $this->src = dechex($this->src);
                        $this->src = sprintf('%08s', $this->src);
                    }

                    break;
            }
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

            $opcode = dechex($base) . $this->src;
            $opcodeLen = strlen($opcode);

            $this->setOpcode(pack('H*', $opcode));
            $this->setLen($opcodeLen / 2);
        } elseif ($isStrSrc && $isStrDst && $lenSrc == 2 && $lenDst == 2) {
            parent::__construct($this->src, $this->dst);
        } elseif ($isStrSrc && $isStrDst && $lenSrc == 3 && $lenDst == 3) {
            if ($this->isValidRegisterSize($src, $dst)) {
                $pre = '';
                $preLen = 0;

                switch ($this->src[0]) {
                    /*case 'e':
                        break;*/
                    case 'r':
                        $pre = pack('H*', '48');
                        $preLen++;
                        break;
                }

                $tSrc = $this->src;
                $tDst = $this->dst;

                $tSrc = $tSrc[1] . $tSrc[2];
                $tDst = $tDst[1] . $tDst[2];

                $instr = new X86Mov($tSrc, $tDst);
                $this->setOpcode($pre . $instr->assemble());
                $this->setLen($instr->getLen() + $preLen);
            }
        }
    }
}

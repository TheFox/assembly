<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction\X86\Mov as X86Mov;

class Mov extends X86Mov
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
        $isNumDst = is_numeric($this->dst);
        $isStrDst = is_string($this->dst);

        if ($isNumSrc && $isStrDst && $lenDst == 2) {
            $pre = '';
            $preLen = 0;
            switch ($this->dst) {
                case 'ax':
                case 'cx':
                case 'dx':
                case 'bx':
                    $pre = pack('H*', '66');
                    $preLen++;
                    break;
            }

            // $instr = new X86Mov($this->src, $this->dst);
            // $this->setOpcode($pre.$instr->assemble());
            // $this->setLen($instr->getLen() + $preLen);
            parent::__construct($this->src, $this->dst);
            $this->setOpcode($pre . $this->assemble());
            $this->setLen($this->getLen() + $preLen);
        } elseif ($isNumSrc && $isStrDst && $lenDst == 3) {
            $mask = 0xffffffff;
            $base = 0xB8;
            $len = 4;

            switch ($this->dst[1]) {
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

            $this->src &= $mask;
            $this->src = Num::be2le($this->src, $len);

            $base <<= $len * 8;
            $opcode = dechex($base | $this->src);
            $opcodeLen = strlen($opcode);

            $this->setOpcode(pack('H*', $opcode));
            $this->setLen($opcodeLen / 2);
        } elseif ($isStrSrc && $isStrDst && $lenSrc == 2 && $lenDst == 2) {
            $pre = '';
            $preLen = 0;
            switch ($this->dst) {
                case 'ax':
                case 'cx':
                case 'dx':
                case 'bx':
                    $pre = pack('H*', '66');
                    $preLen++;
                    break;
            }

            // $instr = new X86Mov($this->src, $this->dst);
            // $this->setOpcode($pre.$instr->assemble());
            // $this->setLen($instr->getLen() + $preLen);
            parent::__construct($this->src, $this->dst);
            $this->setOpcode($pre . $this->assemble());
            $this->setLen($this->getLen() + $preLen);
        } elseif ($isStrSrc && $isStrDst && $lenSrc == 3 && $lenDst == 3) {
            if ($this->isValidRegisterSize()) {
                #\Doctrine\Common\Util\Debug::dump($this->src);
                $tSrc = $this->src;
                $tDst = $this->dst;

                $tSrc = $tSrc[1] . $tSrc[2];
                $tDst = $tDst[1] . $tDst[2];

                parent::__construct($tSrc, $tDst);
                // $instr = new X86Mov($tSrc, $tDst);
                // $this->setOpcode($instr->assemble());
                // $this->setLen($instr->getLen());
            }
        }
    }

    /**
     * @param null|string $tSrc
     * @param null|string $tDst
     * @return bool
     */
    public function isValidRegisterSize(string $tSrc = null, string $tDst = null): bool
    {
        if ($tSrc === null) {
            $tSrc = $this->src;
        }
        if ($tDst === null) {
            $tDst = $this->dst;
        }

        $sLen = strlen($tSrc);
        $dLen = strlen($tDst);

        if ($sLen == 2 && $dLen == 2) {
            return parent::isValidRegisterSize($tSrc, $tDst);
        } elseif ($sLen == 3 && $dLen == 3) {
            if ($tSrc[0] == $tDst[0]) {
                $tSrc = $tSrc[1] . $tSrc[2];
                $tDst = $tDst[1] . $tDst[2];
                return parent::isValidRegisterSize($tSrc, $tDst);
            }
        }

        return false;
    }
}

<?php

// http://www.mathemainzel.info/files/x86asmref.html#mov

namespace TheFox\Assembly\Instruction\X86;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction;

class Mov extends Instruction
{
    /**
     * @var string|int
     */
    public $src;

    /**
     * @var string
     */
    public $dst;

    /**
     * Mov constructor.
     * @param int|string $src
     * @param string $dst
     */
    public function __construct($src, string $dst)
    {
        $this->src = strtolower($src);
        $this->dst = strtolower($dst);

        $lenSrc = strlen($this->src);
        $isNumSrc = is_numeric($this->src);
        $isStrSrc = is_string($this->src);

        $lenDst = strlen($this->dst);
        //$isNumDst = is_numeric($this->dst);
        $isStrDst = is_string($this->dst);

        if ($isNumSrc && $isStrDst && $lenDst == 2) {
            $mask = 0xff;
            $base = 0xB0;
            $len = 1;

            switch ($this->dst[1]) {
                /*case 'l':
                    $mask = 0xff;
                    $base += 0;
                    break;*/
                case 'h':
                    #$mask = 0xff;
                    $base += 4;
                    break;
                case 'x':
                    $mask = 0xffff;
                    $base += 8;
                    $len = 2;
                    break;
            }
            switch ($this->dst[0]) {
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
            
            parent::__construct($opcodeLen / 2);
        } elseif ($isStrSrc && $isStrDst && $lenSrc == 2 && $lenDst == 2) {
            if ($this->isValidRegisterSize()) {
                $base = 0x8800;
                switch ($this->src[1]) {
                    case 'x':
                        $base += 0x100;
                    case 'l':
                        $base += 0xc0;
                        break;
                    case 'h':
                        $base += 0xe0;
                        break;
                }
                switch ($this->src[0]) {
                    /*case 'a':
                        $base += 0;
                        break;*/
                    case 'c':
                        $base += 8;
                        break;
                    case 'd':
                        $base += 0x10;
                        break;
                    case 'b':
                        $base += 0x18;
                        break;
                }
                switch ($this->dst[1]) {
                    /*case 'l':
                        $base += 0;
                        break;*/
                    case 'h':
                        $base += 4;
                        break;
                }
                switch ($this->dst[0]) {
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

                parent::__construct($opcodeLen / 2);
            }
        }
    }

    /**
     * @param string|null $tSrc
     * @param string|null $tDst
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

        if ($tSrc[1] == $tDst[1]) {
            return true;
        } elseif (($tSrc[1] == 'l' || $tSrc[1] == 'h')
            && ($tDst[1] == 'l' || $tDst[1] == 'h')
        ) {
            return true;
        }

        return false;
    }
}

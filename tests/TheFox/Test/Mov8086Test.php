<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Mov;

class Mov8086Test extends MovTest
{
    /**
     * @dataProvider basicProvider
     */
    public function test8086Basic($src, $dst, $expected, $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit8ValueToRegisterProvider
     */
    public function test8086Bit8ValueToRegister($src, $dst, $expected, $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit8RegisterToRegisterProvider
     */
    public function test8086Bit8RegisterToRegister($src, $dst, $expected, $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit16ValueToRegisterProvider
     */
    public function test8086Bit16ValueToRegister($src, $dst, $expected, $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit16RegisterToRegisterProvider
     */
    public function test8086Bit16RegisterToRegister($src, $dst, $expected, $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit8IsValidRegisterSizeProvider
     */
    public function test8086Bit8IsValidRegisterSize($src, $dst, $expected)
    {
        $instr = new Mov($src, $dst);
        $this->assertEquals($expected, $instr->isValidRegisterSize());
    }

    /**
     * @dataProvider bit16IsValidRegisterSizeProvider
     */
    public function test8086Bit16IsValidRegisterSize($src, $dst, $expected)
    {
        $instr = new Mov($src, $dst);
        $this->assertEquals($expected, $instr->isValidRegisterSize());
    }
}

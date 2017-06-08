<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Mov;

class Mov8086Test extends MovTest
{
    /**
     * @dataProvider basicProvider
     * @param $src
     * @param $dst
     * @param string $expected
     * @param int $len
     */
    public function test8086Basic($src, $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit8ValueToRegisterProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function test8086Bit8ValueToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit8RegisterToRegisterProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function test8086Bit8RegisterToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit16ValueToRegisterProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function test8086Bit16ValueToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit16RegisterToRegisterProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function test8086Bit16RegisterToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit8IsValidRegisterSizeProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     */
    public function test8086Bit8IsValidRegisterSize(string $src, string $dst, string $expected)
    {
        $instr = new Mov($src, $dst);
        $this->assertEquals($expected, $instr->isValidRegisterSize());
    }

    /**
     * @dataProvider bit16IsValidRegisterSizeProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     */
    public function test8086Bit16IsValidRegisterSize(string $src, string $dst, string $expected)
    {
        $instr = new Mov($src, $dst);
        $this->assertEquals($expected, $instr->isValidRegisterSize());
    }
}

<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\I386\Mov;

class MovI386Test extends MovTest
{
    /**
     * @dataProvider basicProvider
     * @param $src
     * @param $dst
     * @param string $expected
     * @param int $len
     */
    public function testI386Basic($src, $dst, string $expected, int $len)
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
    public function testI386Bit8ValueToRegister(string $src, string $dst, string $expected, int $len)
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
    public function testI386Bit8RegisterToRegister(string $src, string $dst, string $expected, int $len)
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
    public function testI386Bit16ValueToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), '66' . $expected, $len + 1);
    }

    /**
     * @dataProvider bit16RegisterToRegisterProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function testI386Bit16RegisterToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), '66' . $expected, $len + 1);
    }

    /**
     * @dataProvider bit32ValueToRegisterProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function testI386Bit32ValueToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit32RegisterToRegisterProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function testI386Bit32RegisterToRegister(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new Mov($src, $dst), $expected, $len);
    }

    /**
     * @dataProvider bit8IsValidRegisterSizeProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     */
    public function testI386Bit8IsValidRegisterSize(string $src, string $dst, string $expected)
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
    public function testI386Bit16IsValidRegisterSize(string $src, string $dst, string $expected)
    {
        $instr = new Mov($src, $dst);
        $this->assertEquals($expected, $instr->isValidRegisterSize());
    }

    /**
     * @dataProvider bit32IsValidRegisterSizeProvider
     * @param string $src
     * @param string $dst
     * @param string $expected
     */
    public function testI386Bit32IsValidRegisterSize(string $src, string $dst, string $expected)
    {
        $instr = new Mov($src, $dst);
        $this->assertEquals($expected, $instr->isValidRegisterSize());
    }
}

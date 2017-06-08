<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86\Push as X8086Push;
use TheFox\Assembly\Instruction\I386\Push as I386Push;
use TheFox\Assembly\Instruction\X86_64\Push as X8664Push;

class PushTest extends BasicTestCase
{
    public function x8086Provider()
    {
        $rv = [];

        $rv[] = ['', '', 0];
        $rv[] = ['XYZ', '', 0];

        $rv[] = ['ax', '50', 1];
        $rv[] = ['cx', '51', 1];
        $rv[] = ['dx', '52', 1];
        $rv[] = ['bx', '53', 1];

        return $rv;
    }

    /**
     * @dataProvider x8086Provider
     */
    public function test8086($register, $expected, $len)
    {
        $this->basicTest(new X8086Push($register), $expected, $len);
    }

    public function i386Provider()
    {
        $rv = [];

        $rv[] = ['', '', 0];
        $rv[] = ['XYZ', '', 0];

        $rv[] = ['ax', '6650', 2];
        $rv[] = ['cx', '6651', 2];
        $rv[] = ['dx', '6652', 2];
        $rv[] = ['bx', '6653', 2];

        $rv[] = ['eax', '50', 1];
        $rv[] = ['ecx', '51', 1];
        $rv[] = ['edx', '52', 1];
        $rv[] = ['ebx', '53', 1];

        return $rv;
    }

    /**
     * @dataProvider i386Provider
     */
    public function testI386($register, $expected, $len)
    {
        $this->basicTest(new I386Push($register), $expected, $len);
    }

    public function x8664Provider()
    {
        $rv = [];

        $rv[] = ['', '', 0];
        $rv[] = ['XYZ', '', 0];

        $rv[] = ['ax', '6650', 2];
        $rv[] = ['cx', '6651', 2];
        $rv[] = ['dx', '6652', 2];
        $rv[] = ['bx', '6653', 2];

        $rv[] = ['rax', '50', 1];
        $rv[] = ['rcx', '51', 1];
        $rv[] = ['rdx', '52', 1];
        $rv[] = ['rbx', '53', 1];

        return $rv;
    }

    /**
     * @dataProvider x8664Provider
     */
    public function testX8664($register, $expected, $len)
    {
        $this->basicTest(new X8664Push($register), $expected, $len);
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionCode 1
     */
    public function testX8664UnexpectedValueException()
    {
        $instr = new X8664Push('eax');
        $instr = new X8664Push('ecx');
        $instr = new X8664Push('edx');
        $instr = new X8664Push('ebx');
    }
}

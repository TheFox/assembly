<?php

namespace TheFox\Test;

use UnexpectedValueException;
use TheFox\Assembly\Instruction\X86\Pop as X8086Pop;
use TheFox\Assembly\Instruction\I386\Pop as I386Pop;
use TheFox\Assembly\Instruction\X86_64\Pop as X8664Pop;

class PopTest extends BasicTestCase
{
    /**
     * @return array
     */
    public function x8086Provider(): array
    {
        $rv = [];

        $rv[] = ['', '', 0];
        $rv[] = ['XYZ', '', 0];

        $rv[] = ['ax', '58', 1];
        $rv[] = ['cx', '59', 1];
        $rv[] = ['dx', '5a', 1];
        $rv[] = ['bx', '5b', 1];

        return $rv;
    }

    /**
     * @dataProvider x8086Provider
     * @param string $register
     * @param string $expected
     * @param int $len
     */
    public function test8086(string $register, string $expected, int $len)
    {
        $this->basicTest(new X8086Pop($register), $expected, $len);
    }

    /**
     * @return array
     */
    public function i386Provider(): array
    {
        $rv = [];

        $rv[] = ['', '', 0];
        $rv[] = ['XYZ', '', 0];

        $rv[] = ['ax', '6658', 2];
        $rv[] = ['cx', '6659', 2];
        $rv[] = ['dx', '665a', 2];
        $rv[] = ['bx', '665b', 2];

        $rv[] = ['eax', '58', 1];
        $rv[] = ['ecx', '59', 1];
        $rv[] = ['edx', '5a', 1];
        $rv[] = ['ebx', '5b', 1];

        return $rv;
    }

    /**
     * @dataProvider i386Provider
     * @param string $register
     * @param string $expected
     * @param int $len
     */
    public function testI386(string $register, string $expected, int $len)
    {
        $this->basicTest(new I386Pop($register), $expected, $len);
    }

    /**
     * @return array
     */
    public function x8664Provider(): array
    {
        $rv = [];

        $rv[] = ['', '', 0];
        $rv[] = ['XYZ', '', 0];

        $rv[] = ['ax', '6658', 2];
        $rv[] = ['cx', '6659', 2];
        $rv[] = ['dx', '665a', 2];
        $rv[] = ['bx', '665b', 2];

        // throws Exception, see testX8664UnexpectedValueException()
        // $rv[] = array('eax', '58', 1);
        // $rv[] = array('ecx', '59', 1);
        // $rv[] = array('edx', '5a', 1);
        // $rv[] = array('ebx', '5b', 1);

        $rv[] = ['rax', '58', 1];
        $rv[] = ['rcx', '59', 1];
        $rv[] = ['rdx', '5a', 1];
        $rv[] = ['rbx', '5b', 1];

        return $rv;
    }

    /**
     * @dataProvider x8664Provider
     * @param string $register
     * @param string $expected
     * @param int $len
     */
    public function testX8664(string $register, string $expected, int $len)
    {
        $this->basicTest(new X8664Pop($register), $expected, $len);
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionCode 1
     */
    public function testX8664UnexpectedValueException()
    {
        $instr = new X8664Pop('eax');
        $instr = new X8664Pop('ecx');
        $instr = new X8664Pop('edx');
        $instr = new X8664Pop('ebx');
    }
}

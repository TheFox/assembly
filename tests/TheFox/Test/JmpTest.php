<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction;
use TheFox\Assembly\Instruction\X86\Jmp as X8086Jmp;
use TheFox\Assembly\Instruction\I386\Jmp as I386Jmp;
use TheFox\Assembly\Instruction\X86_64\Jmp as X8664Jmp;

class JmpTest extends BasicTestCase
{
    /**
     * @return array
     */
    public function x8086ValueProvider(): array
    {
        $rv = [];

        $rv[] = ['', '', 2];

        $rv[] = [-0x8001, '', 2];

        $rv[] = [-0x8000, 'e90080', 3];
        $rv[] = [-0x7fff, 'e90180', 3];
        $rv[] = [-0x7ffe, 'e90280', 3];

        $rv[] = [-0x1001, 'e9ffef', 3];
        $rv[] = [-0x1000, 'e900f0', 3];
        $rv[] = [-0xfff, 'e901f0', 3];
        $rv[] = [-0xffe, 'e902f0', 3];

        $rv[] = [-0x801, 'e9fff7', 3];
        $rv[] = [-0x800, 'e900f8', 3];
        $rv[] = [-0x7ff, 'e901f8', 3];
        $rv[] = [-0x7fe, 'e902f8', 3];

        $rv[] = [-0x101, 'e9fffe', 3];
        $rv[] = [-0x100, 'e900ff', 3];
        $rv[] = [-0xff, 'e901ff', 3];
        $rv[] = [-0xfe, 'e902ff', 3];

        $rv[] = [-0x83, 'e97dff', 3];
        $rv[] = [-0x82, 'e97eff', 3];
        $rv[] = [-0x81, 'e97fff', 3];

        $rv[] = [-0x80, 'eb80', 2];
        $rv[] = [-0x7f, 'eb81', 2];
        $rv[] = [-0x7e, 'eb82', 2];

        $rv[] = [-2, 'ebfe', 2];
        $rv[] = [-1, 'ebff', 2];
        $rv[] = [0, 'eb00', 2];
        $rv[] = [1, 'eb01', 2];
        $rv[] = [2, 'eb02', 2];

        $rv[] = [0x7e, 'eb7e', 2];
        $rv[] = [0x7f, 'eb7f', 2];

        $rv[] = [0x80, 'e98000', 3];
        $rv[] = [0x81, 'e98100', 3];
        $rv[] = [0xff, 'e9ff00', 3];
        $rv[] = [0x100, 'e90001', 3];
        $rv[] = [0x101, 'e90101', 3];

        $rv[] = [0x7fff, 'e9ff7f', 3];

        $rv[] = [0x8000, '', 2];

        return $rv;
    }

    /**
     * @dataProvider x8086ValueProvider
     * @param string|int $offset
     * @param string $expected
     * @param int $len
     */
    public function test8086Value($offset, string $expected, int $len)
    {
        $this->basicTest(new X8086Jmp($offset), $expected, $len);
    }

    /**
     * @return array
     */
    public function x8086StringProvider(): array
    {
        $rv = [];

        $rv[] = ['ax', 'ffe0', 2];
        $rv[] = ['cx', 'ffe1', 2];
        $rv[] = ['dx', 'ffe2', 2];
        $rv[] = ['bx', 'ffe3', 2];

        return $rv;
    }

    /**
     * @dataProvider x8086StringProvider
     * @param string $register
     * @param string $expected
     * @param int $len
     */
    public function test8086String(string $register, string $expected, int $len)
    {
        $this->basicTest(new X8086Jmp($register), $expected, $len);
    }

    /**
     * @return array
     */
    public function x8086ObjectProvider(): array
    {
        $rv = [];

        $rv[] = [6, 8, 'eb00'];
        $rv[] = [6, 7, 'ebff'];
        $rv[] = [6, 9, 'eb01'];
        $rv[] = [0, 0x80, 'eb7e'];
        $rv[] = [0, 0x80 + 1, 'eb7f'];
        $rv[] = [0, 0x80 + 2, 'e98000'];
        $rv[] = [0, 0x80 + 3, 'e98100'];
        $rv[] = [0, 0xf00 + 0x80, 'e97e0f'];
        $rv[] = [0, 0xf00 + 0x80 + 3, 'e9810f'];

        $rv[] = [8, 7, 'ebfd'];
        $rv[] = [150, 149, 'ebfd'];
        $rv[] = [1500, 1499, 'ebfd'];

        $rv[] = [0x7e, 0, 'eb80'];
        $rv[] = [0x7f, 0, 'e97eff'];
        $rv[] = [0x80, 0, 'e97dff'];

        $rv[] = [0, 0, 'ebfe'];
        $rv[] = [150, 150, 'ebfe'];

        return $rv;
    }

    /**
     * @dataProvider x8086ObjectProvider
     * @param int $offsetJmp
     * @param int $offsetInstr
     * @param string $expected
     */
    public function test8086Object(int $offsetJmp, int $offsetInstr, string $expected)
    {
        $instr1 = new Instruction();
        $instr1->setOffset($offsetInstr);

        $jmp1 = new X8086Jmp($instr1);
        $jmp1->setOffset($offsetJmp);

        $opcode = unpack('H*', $jmp1->assemble());
        $opcode = $opcode[1];
        $this->assertEquals($expected, $opcode);
    }

    public function test8086Self()
    {
        $jmp1 = new X8086Jmp(0);
        $jmp1->dst = $jmp1;
        $jmp1->setOffset(10);

        $opcode = unpack('H*', $jmp1->assemble());
        $opcode = $opcode[1];
        $this->assertEquals('ebfe', $opcode);
    }

    /**
     * @return array
     */
    public function i386ValueProvider(): array
    {
        $rv = [];

        $rv[] = ['', '', 2];

        $rv[] = [-0x80000001, '', 2];

        $rv[] = [-0x80000000, 'e900000080', 5];
        $rv[] = [-0x7fffffff, 'e901000080', 5];
        $rv[] = [-0x7ffffffe, 'e902000080', 5];

        $rv[] = [-0x1001, 'e9ffefffff', 5];
        $rv[] = [-0x1000, 'e900f0ffff', 5];
        $rv[] = [-0xfff, 'e901f0ffff', 5];
        $rv[] = [-0xffe, 'e902f0ffff', 5];

        $rv[] = [-0x801, 'e9fff7ffff', 5];
        $rv[] = [-0x800, 'e900f8ffff', 5];
        $rv[] = [-0x7ff, 'e901f8ffff', 5];
        $rv[] = [-0x7fe, 'e902f8ffff', 5];

        $rv[] = [-0x101, 'e9fffeffff', 5];
        $rv[] = [-0x100, 'e900ffffff', 5];
        $rv[] = [-0xff, 'e901ffffff', 5];
        $rv[] = [-0xfe, 'e902ffffff', 5];

        $rv[] = [-0x83, 'e97dffffff', 5];
        $rv[] = [-0x82, 'e97effffff', 5];
        $rv[] = [-0x81, 'e97fffffff', 5];

        $rv[] = [-0x80, 'eb80', 2];
        $rv[] = [-0x7f, 'eb81', 2];
        $rv[] = [-0x7e, 'eb82', 2];

        $rv[] = [-2, 'ebfe', 2];
        $rv[] = [-1, 'ebff', 2];
        $rv[] = [0, 'eb00', 2];
        $rv[] = [1, 'eb01', 2];
        $rv[] = [2, 'eb02', 2];

        $rv[] = [0x7e, 'eb7e', 2];
        $rv[] = [0x7f, 'eb7f', 2];

        $rv[] = [0x80, 'e980000000', 5];
        $rv[] = [0x81, 'e981000000', 5];
        $rv[] = [0xff, 'e9ff000000', 5];
        $rv[] = [0x100, 'e900010000', 5];
        $rv[] = [0x101, 'e901010000', 5];

        $rv[] = [0x7fffffff, 'e9ffffff7f', 5];

        $rv[] = [0x80000000, '', 2];

        return $rv;
    }

    /**
     * @dataProvider i386ValueProvider
     * @param $offset
     * @param string $expected
     * @param int $len
     */
    public function testI386Value($offset, string $expected, int $len)
    {
        $this->basicTest(new I386Jmp($offset), $expected, $len);
    }

    /**
     * @return array
     */
    public function i386StringProvider(): array
    {
        $rv = [];

        $rv[] = ['ax', '66ffe0', 3];
        $rv[] = ['cx', '66ffe1', 3];
        $rv[] = ['dx', '66ffe2', 3];
        $rv[] = ['bx', '66ffe3', 3];

        $rv[] = ['eax', 'ffe0', 2];
        $rv[] = ['ecx', 'ffe1', 2];
        $rv[] = ['edx', 'ffe2', 2];
        $rv[] = ['ebx', 'ffe3', 2];

        return $rv;
    }

    /**
     * @dataProvider i386StringProvider
     * @param string $register
     * @param string $expected
     * @param int $len
     */
    public function testI386String(string $register, string $expected, int $len)
    {
        $this->basicTest(new I386Jmp($register), $expected, $len);
    }

    /**
     * @return array
     */
    public function i386ObjectProvider(): array
    {
        $rv = [];

        $rv[] = [6, 8, 'eb00'];
        $rv[] = [6, 7, 'ebff'];
        $rv[] = [6, 9, 'eb01'];
        $rv[] = [0, 0x80, 'eb7e'];
        $rv[] = [0, 0x80 + 1, 'eb7f'];
        $rv[] = [0, 0x80 + 2, 'e980000000'];
        $rv[] = [0, 0x80 + 3, 'e981000000'];
        $rv[] = [0, 0xf00 + 0x80, 'e97e0f0000'];
        $rv[] = [0, 0xf00 + 0x80 + 3, 'e9810f0000'];

        $rv[] = [8, 7, 'ebfd'];
        $rv[] = [150, 149, 'ebfd'];
        $rv[] = [1500, 1499, 'ebfd'];

        $rv[] = [0x7e, 0, 'eb80'];
        $rv[] = [0x7f, 0, 'e97cffffff'];
        $rv[] = [0x80, 0, 'e97bffffff'];

        $rv[] = [0, 0, 'ebfe'];
        $rv[] = [150, 150, 'ebfe'];

        return $rv;
    }

    /**
     * @dataProvider i386ObjectProvider
     * @param int $offsetJmp
     * @param int $offsetInstr
     * @param string $expected
     */
    public function testI386Object(int $offsetJmp, int $offsetInstr, string $expected)
    {
        $instr1 = new Instruction();
        $instr1->setOffset($offsetInstr);

        $jmp1 = new I386Jmp($instr1);
        $jmp1->setOffset($offsetJmp);

        $opcode = unpack('H*', $jmp1->assemble());
        $opcode = $opcode[1];
        $this->assertEquals($expected, $opcode);
    }

    public function testI386Self()
    {
        $jmp1 = new I386Jmp(0);
        $jmp1->dst = $jmp1;
        $jmp1->setOffset(10);

        $opcode = unpack('H*', $jmp1->assemble());
        $opcode = $opcode[1];
        $this->assertEquals('ebfe', $opcode);
    }

    /**
     * @return array
     */
    public function x8664ValueProvider(): array
    {
        $rv = [];

        $rv[] = ['', '', 2];

        $rv[] = [-0x80000001, '', 2];

        $rv[] = [-0x80000000, 'e900000080', 5];
        $rv[] = [-0x7fffffff, 'e901000080', 5];
        $rv[] = [-0x7ffffffe, 'e902000080', 5];

        $rv[] = [-0x1001, 'e9ffefffff', 5];
        $rv[] = [-0x1000, 'e900f0ffff', 5];
        $rv[] = [-0xfff, 'e901f0ffff', 5];
        $rv[] = [-0xffe, 'e902f0ffff', 5];

        $rv[] = [-0x801, 'e9fff7ffff', 5];
        $rv[] = [-0x800, 'e900f8ffff', 5];
        $rv[] = [-0x7ff, 'e901f8ffff', 5];
        $rv[] = [-0x7fe, 'e902f8ffff', 5];

        $rv[] = [-0x101, 'e9fffeffff', 5];
        $rv[] = [-0x100, 'e900ffffff', 5];
        $rv[] = [-0xff, 'e901ffffff', 5];
        $rv[] = [-0xfe, 'e902ffffff', 5];

        $rv[] = [-0x83, 'e97dffffff', 5];
        $rv[] = [-0x82, 'e97effffff', 5];
        $rv[] = [-0x81, 'e97fffffff', 5];

        $rv[] = [-0x80, 'eb80', 2];
        $rv[] = [-0x7f, 'eb81', 2];
        $rv[] = [-0x7e, 'eb82', 2];

        $rv[] = [-2, 'ebfe', 2];
        $rv[] = [-1, 'ebff', 2];
        $rv[] = [0, 'eb00', 2];
        $rv[] = [1, 'eb01', 2];
        $rv[] = [2, 'eb02', 2];

        $rv[] = [0x7e, 'eb7e', 2];
        $rv[] = [0x7f, 'eb7f', 2];

        $rv[] = [0x80, 'e980000000', 5];
        $rv[] = [0x81, 'e981000000', 5];
        $rv[] = [0xff, 'e9ff000000', 5];
        $rv[] = [0x100, 'e900010000', 5];
        $rv[] = [0x101, 'e901010000', 5];

        $rv[] = [0x7fffffff, 'e9ffffff7f', 5];

        $rv[] = [0x80000000, '', 2];

        return $rv;
    }

    /**
     * @dataProvider x8664ValueProvider
     * @param $offset
     * @param string $expected
     * @param int $len
     */
    public function test8664Value($offset, string $expected, int $len)
    {
        $this->basicTest(new X8664Jmp($offset), $expected, $len);
    }

    /**
     * @return array
     */
    public function x8664StringProvider(): array
    {
        $rv = [];

        $rv[] = ['ax', '66ffe0', 3];
        $rv[] = ['cx', '66ffe1', 3];
        $rv[] = ['dx', '66ffe2', 3];
        $rv[] = ['bx', '66ffe3', 3];

        $rv[] = ['rax', 'ffe0', 2];
        $rv[] = ['rcx', 'ffe1', 2];
        $rv[] = ['rdx', 'ffe2', 2];
        $rv[] = ['rbx', 'ffe3', 2];

        return $rv;
    }

    /**
     * @dataProvider x8664StringProvider
     */
    public function testX8664String(string $register, string $expected, int $len)
    {
        $this->basicTest(new X8664Jmp($register), $expected, $len);
    }

    /**
     * @return array
     */
    public function x8664ObjectProvider(): array
    {
        $rv = [];

        $rv[] = [6, 8, 'eb00'];
        $rv[] = [6, 7, 'ebff'];
        $rv[] = [6, 9, 'eb01'];
        $rv[] = [0, 0x80, 'eb7e'];
        $rv[] = [0, 0x80 + 1, 'eb7f'];
        $rv[] = [0, 0x80 + 2, 'e980000000'];
        $rv[] = [0, 0x80 + 3, 'e981000000'];
        $rv[] = [0, 0xf00 + 0x80, 'e97e0f0000'];
        $rv[] = [0, 0xf00 + 0x80 + 3, 'e9810f0000'];

        $rv[] = [8, 7, 'ebfd'];
        $rv[] = [150, 149, 'ebfd'];
        $rv[] = [1500, 1499, 'ebfd'];

        $rv[] = [0x7e, 0, 'eb80'];
        $rv[] = [0x7f, 0, 'e97cffffff'];
        $rv[] = [0x80, 0, 'e97bffffff'];

        $rv[] = [0, 0, 'ebfe'];
        $rv[] = [150, 150, 'ebfe'];

        return $rv;
    }

    /**
     * @dataProvider x8664ObjectProvider
     * @param int $offsetJmp
     * @param int $offsetInstr
     * @param string $expected
     */
    public function test8664Object(int $offsetJmp, int $offsetInstr, string $expected)
    {
        $instr1 = new Instruction();
        $instr1->setOffset($offsetInstr);

        $jmp1 = new X8664Jmp($instr1);
        $jmp1->setOffset($offsetJmp);

        $opcode = unpack('H*', $jmp1->assemble());
        $opcode = $opcode[1];
        $this->assertEquals($expected, $opcode);
    }

    public function testX8664Self()
    {
        $jmp1 = new X8664Jmp(0);
        $jmp1->dst = $jmp1;
        $jmp1->setOffset(10);

        $opcode = unpack('H*', $jmp1->assemble());
        $opcode = $opcode[1];
        $this->assertEquals('ebfe', $opcode);
    }
}

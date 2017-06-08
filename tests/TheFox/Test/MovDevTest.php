<?php

namespace TheFox\Test;

use TheFox\Assembly\Instruction\X86_64\Mov as X8664Mov;

class MovDevTest extends BasicTestCase
{
    /**
     * @return array
     */
    public function x8664ProviderDev(): array
    {
        $rv = [];

        $rv[] = ['eax', 'eax', '89c0', 2];
        $rv[] = ['rax', 'rax', '4889c0', 3];

        return $rv;
    }

    /**
     * @dataProvider x8664ProviderDev
     * @param string $src
     * @param string $dst
     * @param string $expected
     * @param int $len
     */
    public function testX8664dev(string $src, string $dst, string $expected, int $len)
    {
        $this->basicTest(new X8664Mov($src, $dst), $expected, $len);
    }
}

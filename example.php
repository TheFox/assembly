<?php

require_once __DIR__.'/vendor/autoload.php';

use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction\X86\Instruction as X86Instruction;
use TheFox\Assembly\Instruction\X86\Ret;
use TheFox\Assembly\Instruction\X86\Nop;
use TheFox\Assembly\Instruction\X86_64\Instruction as X8664Instruction;

$instr86 = new X86Instruction();
$instr8664 = new X8664Instruction();

$asm = new Assembly();
$asm->addInstruction(new Ret());
$asm->addInstruction(new Nop());
$asm->addInstruction(new Nop());
$asm->addInstruction(new Nop());
\Doctrine\Common\Util\Debug::dump($asm);


$opcode = $asm->assemble();
\Doctrine\Common\Util\Debug::dump($opcode);

$hex = unpack('H*', $opcode);
\Doctrine\Common\Util\Debug::dump($hex);

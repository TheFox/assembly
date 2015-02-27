<?php

require_once __DIR__.'/vendor/autoload.php';

use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction\X86_64\Nop;
use TheFox\Assembly\Instruction\X86_64\Ret;

$asm = new Assembly();
$asm->addInstruction(new Nop());
$asm->addInstruction(new Nop());
$asm->addInstruction(new Nop());
$asm->addInstruction(new Ret());

$opcode = $asm->assemble();

$hex = unpack('H*', $opcode);
\Doctrine\Common\Util\Debug::dump($hex);

<?php

require_once __DIR__.'/vendor/autoload.php';

use TheFox\Assembly\Assembly;
use TheFox\Assembly\Instruction\X86_64\Mov;
use TheFox\Assembly\Instruction\X86_64\Jmp;
use TheFox\Assembly\Instruction\X86_64\Nop;
use TheFox\Assembly\Instruction\X86_64\Ret;


$retInstr = new Ret();

$asm = new Assembly();
$asm->addInstruction(new Mov('rax', 'rbx'));
$asm->addInstruction(new Jmp($retInstr));
$asm->addInstruction(new Nop());
$asm->addInstruction($retInstr);
$asm->addInstruction(new Nop());

$opcode = $asm->assemble();

$hex = unpack('H*', $opcode);
$hex = $hex[1];
print 'hex opcode: '.$hex."\n";

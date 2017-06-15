<?php

namespace TheFox\Assembly;

class Assembly
{
    const NAME = 'Assembly';
    const VERSION = '0.5.0-dev.1';

    /**
     * @var int
     */
    private $instructionId = 0;

    /**
     * @var array
     */
    private $instructions = [];

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @param Instruction $instr
     */
    public function addInstruction(Instruction $instr)
    {
        $this->instructions[$this->instructionId] = $instr;

        $instr->setId($this->instructionId);
        $instr->setAssembly($this);
        $instr->setOffset($this->offset);
        $this->offset += $instr->getLen();

        $this->instructionId++;
    }

    /**
     * @param Instruction $instr
     * @param int $newLen
     */
    public function updateInstructionLen(Instruction $instr, int $newLen)
    {
        $lenOffset = $newLen - $instr->getLen();

        $this->offset += $lenOffset;

        for ($instrId = $instr->getId() + 1; $instrId < $this->instructionId; $instrId++) {
            if (isset($this->instructions[$instrId])) {
                $fInstr = $this->instructions[$instrId];
                $fInstr->addOffset($lenOffset);
            }
        }
    }

    /**
     * @return string
     */
    public function assemble(): string
    {
        $opcodes = '';
        foreach ($this->instructions as $instrId => $instr) {
            $opcodes .= $instr->assemble();
        }
        return $opcodes;
    }
}

<?php

namespace TheFox\Assembly;

class Instruction
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var null|Assembly
     */
    private $assembly;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var string
     */
    private $opcode = '';

    /**
     * @var int
     */
    private $len = 0;

    /**
     * Instruction constructor.
     * @param int $len
     */
    public function __construct(int $len = 1)
    {
        $this->setLen($len);
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Assembly $assembly
     */
    public function setAssembly(Assembly $assembly)
    {
        $this->assembly = $assembly;
    }

    /**
     * @return null|Assembly
     */
    public function getAssembly()
    {
        return $this->assembly;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param int $offset
     */
    public function addOffset(int $offset)
    {
        $this->offset += $offset;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param string $opcode
     */
    public function setOpcode(string $opcode)
    {
        $this->opcode = $opcode;
    }

    /**
     * @return string
     */
    public function getOpcode(): string
    {
        return $this->opcode;
    }

    /**
     * @param int $len
     */
    public function setLen(int $len)
    {
        if ($this->getAssembly() && $this->len != $len) {
            $this->getAssembly()->updateInstructionLen($this, $len);
        }
        $this->len = $len;
    }

    /**
     * @return int
     */
    public function getLen(): int
    {
        return $this->len;
    }

    /**
     * @return string
     */
    public function assemble(): string
    {
        return $this->opcode;
    }
}

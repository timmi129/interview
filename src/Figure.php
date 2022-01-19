<?php

use DTO\AvailableStepDTO;

class Figure {
    protected int $steps = 0;
    protected $isBlack;
    protected $canJump = false;

    public function __construct(bool $isBlack) {
        $this->isBlack = $isBlack;
    }

    public function getIsBlack(): bool
    {
        return $this->isBlack;
    }

    public function addStep(): void
    {
        $this->steps++;
    }

    /**
     * @return bool
     */
    public function isCanJump(): bool
    {
        return $this->canJump;
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString() {
        throw new \Exception("Not implemented");
    }

    public function isValidMove(
        string $xFrom,
        int $yFrom,
        string $xTo,
        int $yTo,
        bool $isAttack
    ): bool {

        $availableSteps = $this->getSteps($xFrom, $yFrom, $isAttack);

        foreach ($availableSteps as $validStep) {
            if ($validStep->getX() === ord($xTo) && $validStep->getY() === $yTo && $validStep->isEatStep() === $isAttack) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return AvailableStepDTO[]
     */
    protected function getSteps(
        string $xFrom,
        int $yFrom,
        bool $isAttack
    ): array {
        throw new \Exception("Not implemented");
    }

    protected function checkBorderTable(string $x, int $y): bool
    {

    }
}

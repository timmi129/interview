<?php


namespace DTO;


class AvailableStepDTO
{
    private int $x;
    private int $y;
    private bool $isEatStep;

    public function __construct(int $x, int $y, bool $isEatStep = false)
    {
        $this->x = $x;
        $this->y = $y;
        $this->isEatStep = $isEatStep;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return bool
     */
    public function isEatStep(): bool
    {
        return $this->isEatStep;
    }
}

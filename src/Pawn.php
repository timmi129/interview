<?php

use DTO\AvailableStepDTO;

class Pawn extends Figure {


    public function __toString() {
        return $this->isBlack ? '♟' : '♙';
    }

    /**
     * @return AvailableStepDTO[]
     */
    protected function getSteps(
        string $xFrom,
        int $yFrom,
        bool $isAttack
    ): array {

        $resultArray = [];

        $nextX = ord($xFrom);
        $nextY = $yFrom;

        if ($this->getIsBlack()) {
            $resultArray[] =  new AvailableStepDTO($nextX, $nextY - 1);

            if (0 === $this->steps) {
                $resultArray[] =  new AvailableStepDTO($nextX, $nextY - 2);
            }


            if ($isAttack) {
                $resultArray[] =  new AvailableStepDTO($nextX + 1, $yFrom - 1, true);
                $resultArray[] =  new AvailableStepDTO($nextX - 1, $yFrom - 1, true);
            }
        } else {
            $resultArray[] =  new AvailableStepDTO($nextX, $nextY +1);

            if (0 === $this->steps) {
                $resultArray[] =  new AvailableStepDTO($nextX, $nextY + 2);
            }


            if ($isAttack) {
                $resultArray[] =  new AvailableStepDTO($nextX + 1, $yFrom + 1, true);
                $resultArray[] =  new AvailableStepDTO($nextX - 1, $yFrom + 1, true);
            }
        }

        return $resultArray;
    }
}

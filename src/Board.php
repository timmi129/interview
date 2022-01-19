<?php

class Board {
    private $figures = [];
    private $lastIsBlack = true;

    public function __construct() {
        $this->figures['a'][1] = new Rook(false);
        $this->figures['b'][1] = new Knight(false);
        $this->figures['c'][1] = new Bishop(false);
        $this->figures['d'][1] = new Queen(false);
        $this->figures['e'][1] = new King(false);
        $this->figures['f'][1] = new Bishop(false);
        $this->figures['g'][1] = new Knight(false);
        $this->figures['h'][1] = new Rook(false);

        $this->figures['a'][2] = new Pawn(false);
        $this->figures['b'][2] = new Pawn(false);
        $this->figures['c'][2] = new Pawn(false);
        $this->figures['d'][2] = new Pawn(false);
        $this->figures['e'][2] = new Pawn(false);
        $this->figures['f'][2] = new Pawn(false);
        $this->figures['g'][2] = new Pawn(false);
        $this->figures['h'][2] = new Pawn(false);

        $this->figures['a'][7] = new Pawn(true);
        $this->figures['b'][7] = new Pawn(true);
        $this->figures['c'][7] = new Pawn(true);
        $this->figures['d'][7] = new Pawn(true);
        $this->figures['e'][7] = new Pawn(true);
        $this->figures['f'][7] = new Pawn(true);
        $this->figures['g'][7] = new Pawn(true);
        $this->figures['h'][7] = new Pawn(true);

        $this->figures['a'][8] = new Rook(true);
        $this->figures['b'][8] = new Knight(true);
        $this->figures['c'][8] = new Bishop(true);
        $this->figures['d'][8] = new Queen(true);
        $this->figures['e'][8] = new King(true);
        $this->figures['f'][8] = new Bishop(true);
        $this->figures['g'][8] = new Knight(true);
        $this->figures['h'][8] = new Rook(true);
    }

    public function move($move) {
        if (!preg_match('/^([a-h])(\d)-([a-h])(\d)$/', $move, $match)) {
            throw new \Exception("Incorrect move");
        }


        $xFrom = $match[1];
        $yFrom = $match[2];
        $xTo   = $match[3];
        $yTo   = $match[4];

        if (isset($this->figures[$xFrom][$yFrom])) {
            /** @var Figure $figure */
            $figure = $this->figures[$xFrom][$yFrom];

            if ($figure->getIsBlack() ===  $this->lastIsBlack) {
                throw new Exception('Ошибка очередности кода');
            }

            $isAttack = false;

            if (isset($this->figures[$xTo][$yTo])) {
                $isAttack = true;
            }

            if (!$figure->isValidMove($xFrom, $yFrom, $xTo, $yTo, $isAttack)) {
                throw new Exception('Ошибка хода');
            }

            $this->checkJumpFigure($xFrom, $yFrom, $xTo, $yTo, $figure);


            $this->figures[$xTo][$yTo] = $figure;
            $this->lastIsBlack = $figure->getIsBlack();

            $figure->addStep();
        }
        unset($this->figures[$xFrom][$yFrom]);
    }

    public function dump() {
        for ($y = 8; $y >= 1; $y--) {
            echo "$y ";
            for ($x = 'a'; $x <= 'h'; $x++) {
                if (isset($this->figures[$x][$y])) {
                    echo $this->figures[$x][$y];
                } else {
                    echo '-';
                }
            }
            echo "\n";
        }
        echo "  abcdefgh\n";
    }

    private function checkJumpFigure(
        string $xFrom,
        int $yFrom,
        string $xTo,
        int $yTo,
        Figure $figure
    ): void {
        if ($figure->isCanJump()) {
            return;
        }


        if ($yFrom === $yTo) {
            return;
        }

        if ($figure->getIsBlack()) {
            $yFrom = $yFrom - 1;
        } else {
            $yFrom = $yFrom + 1;
        }


        if (isset($this->figures[$xFrom][$yFrom])) {
            throw new Exception('Ошибка данной фигурой нельзя перепрыгивать');
        }


    }
}

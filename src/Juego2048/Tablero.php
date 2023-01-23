<?php

namespace App\Juego2048;

use phpDocumentor\Reflection\Types\Boolean;

class Tablero implements \Serializable
{
    private const FIL = 4;
    private const COL = 4;

    private array $tablero;

    public function __construct() 
    {
        $this->tablero = array();
        for($f=0;$f<self::FIL;$f++) {           
            for($c=0;$c<self::COL;$c++) {
                $this->tablero[$f][$c] = 0;
            }            
        }
        $this->ponerDos();
        $this->ponerDos();
        
    }

    public function serialize()
    {
        return serialize(
            [
                $this->tablero
            ]
        );
    }

    public function unserialize(string $serialized)
    {
        $data = unserialize($serialized);
        list(
            $this->tablero
        ) = $data;
    }

    public function getTablero(): array
    {
        return $this->tablero;
    }

    private function vaciasEnFila(int $f): int
    {
        $n = 0;
        for($c=0;$c<self::COL;$c++)
            if($this->tablero[$f][$c] == 0)
                $n++;
        return $n;
    }

    private function vaciasEnColumna(int $c): int
    {
        $n = 0;
        for($f=0;$f<self::FIL;$f++)
            if($this->tablero[$f][$c] == 0)
                $n++;
        return $n;
    }

    public function vacias(): int
    {
        $n = 0;
        for($f=0;$f<self::FIL;$f++)
            for($c=0;$c<self::COL;$c++)
                if($this->tablero[$f][$c] == 0)
                    $n++;
        return $n;
    }

    private function noUniones(): bool
    {
        return $this->noUnionesAbajo() && $this->noUnionesDerecha();
    }

    public function noUnionesAbajo(): bool
    {
        for($f=0;$f<self::FIL-1;$f++)
            for($c=0;$c<self::COL;$c++)
                if($this->tablero[$f][$c]!=0 && $this->tablero[$f+1][$c]!=0 &&
                   $this->tablero[$f][$c] == $this->tablero[$f+1][$c])
                    return false;
        return true;
    }

    public function noUnionesDerecha(): bool
    {
        for($f=0;$f<self::FIL;$f++)
            for($c=0;$c<self::COL-1;$c++)
                if($this->tablero[$f][$c]!=0 && $this->tablero[$f][$c+1]!=0 &&
                   $this->tablero[$f][$c] == $this->tablero[$f][$c+1])
                    return false;
        return true;
    }

    private function ponerDos()
    {
        do {
            $f = mt_rand(0,(self::FIL)-1);
        } while($this->vaciasEnFila($f) == 0);

        do {
            $c = mt_rand(0,(self::COL)-1);
        }  while($this->tablero[$f][$c] != 0);

        $this->tablero[$f][$c] = 2;

    }

    public function ganador(): bool
    {
        for($f=0;$f<self::FIL;$f++)
            for($c=0;$c<self::COL;$c++)
                if($this->tablero[$f][$c] == 2048)
                    return true;
        return false;
    }

    public function finPartida(): bool
    {
        return ($this->ganador() || ($this->vacias() == 0 && $this->noUniones()));
    }
   
    public function mueveAbajo():void
    {
        for($c=0;$c<self::COL;$c++)
            $this->mueveAbajoColumna($c);
        if(!$this->finPartida())
            $this->ponerDos();
    }

    private function mueveAbajoColumna(int $c): void
    {
        $this->colocarAbajo($c);
        $this->sumarAbajo($c);
        $this->colocarAbajo($c);
    }

    private function colocarAbajo(int $c): void
    {
        if($this->vaciasEnColumna($c) < self::COL)
            for($veces=0;$veces<(self::FIL)-1;$veces++)
                for($f=(self::FIL)-1;$f>0;$f--)
                    if($this->tablero[$f][$c] == 0) {
                        $this->tablero[$f][$c]=$this->tablero[$f-1][$c];
                        $this->tablero[$f-1][$c]=0;
                    }
    }

    private function sumarAbajo(int $c): void
    {
        if($this->vaciasEnColumna($c) < (self::COL)-1) //solo si hay al menos 2 casillas rellenas
            for($f=(self::FIL)-1;$f>0;$f--)
                if($this->tablero[$f][$c] == $this->tablero[$f-1][$c]) {
                    $this->tablero[$f][$c] *= 2;
                    $this->tablero[$f-1][$c] = 0;
                }
    }

    public function mueveArriba(): void
    {
        for($c=0;$c<self::COL;$c++) 
            $this->mueveArribaColumna($c);
        if(!$this->finPartida())
            $this->ponerDos();
    }

    private function mueveArribaColumna(int $c): void
    {
        $this->colocarArriba($c);
        $this->sumarArriba($c);
        $this->colocarArriba($c);
    }

    private function colocarArriba(int $c): void
    {
        if($this->vaciasEnColumna($c) < self::COL)
            for($veces=0;$veces<(self::FIL)-1;$veces++)
                for($f=0;$f<(self::FIL)-1;$f++)
                    if($this->tablero[$f][$c] == 0) {
                        $this->tablero[$f][$c] = $this->tablero[$f+1][$c];
                        $this->tablero[$f+1][$c] = 0;
                    }
    }

    private function sumarArriba(int $c): void
    {
        if($this->vaciasEnColumna($c) < (self::COL)-1) //solo si hay al menos 2 casillas rellenas
            for($f=0;$f<(self::FIL)-1;$f++)
                if($this->tablero[$f][$c] == $this->tablero[$f+1][$c]) {
                    $this->tablero[$f][$c] *= 2;
                    $this->tablero[$f+1][$c] = 0;
                }
    }

    public function mueveDerecha(): void
    {
        for($f=0;$f<(self::FIL);$f++)
            $this->mueveDerechaFila($f);
        if(!$this->finPartida())
            $this->ponerDos();
    }

    private function mueveDerechaFila(int $f): void
    {
        $this->colocarDerecha($f);
        $this->sumarDerecha($f);
        $this->colocarDerecha($f);
    }

    private function colocarDerecha(int $f): void
    {
        if($this->vaciasEnFila($f) < self::FIL)
            for($veces=0;$veces<(self::COL)-1;$veces++)
                for($c=(self::COL)-1;$c>0;$c--)
                    if($this->tablero[$f][$c] == 0) {
                        $this->tablero[$f][$c] = $this->tablero[$f][$c-1];
                        $this->tablero[$f][$c-1] = 0;
                    }
    }

    private function sumarDerecha(int $f): void
    {
        if($this->vaciasEnFila($f) < (self::FIL)-1) //solo si hay al menos 2 casillas rellenas
            for($c=(self::COL)-1;$c>0;$c--)
                if($this->tablero[$f][$c] == $this->tablero[$f][$c-1]) {
                    $this->tablero[$f][$c] *= 2;
                    $this->tablero[$f][$c-1] = 0;
                }

    }

    public function mueveIzquierda(): void
    {
        for($f=0;$f<self::FIL;$f++)
            $this->mueveIzquierdaFila($f);
        if(!$this->finPartida())
            $this->ponerDos();
    }

    private function mueveIzquierdaFila(int $f): void
    {
        $this->colocarIzquierda($f);
        $this->sumarIzquierda($f);
        $this->colocarIzquierda($f);
    }

    private function colocarIzquierda(int $f): void
    {
        if($this->vaciasEnFila($f) < self::FIL)
            for($veces=0;$veces<(self::COL)-1;$veces++)
                for($c=0;$c<(self::COL)-1;$c++)
                    if($this->tablero[$f][$c] == 0) {
                        $this->tablero[$f][$c] = $this->tablero[$f][$c+1];
                        $this->tablero[$f][$c+1] = 0;
                    }
    }

    private function sumarIzquierda(int $f): void
    {
        if($this->vaciasEnFila($f) < (self::FIL)-1) //solo si hay al menos 2 casillas rellenas
            for($c=0;$c<(self::COL)-1;$c++)
                if($this->tablero[$f][$c] == $this->tablero[$f][$c+1]) {
                    $this->tablero[$f][$c] *= 2;
                    $this->tablero[$f][$c+1] = 0;
                }
    }




}

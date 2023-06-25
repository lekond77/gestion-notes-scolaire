<?php
declare(strict_types=1);
namespace App\Model\SemesterM;

class MEvaluation
{
    private string $evIdentifier;
    private string $typeEv;
    private float $score;

    public function __construct(string $typeEv, float $score)
    {
        $this->typeEv = $typeEv;
        $this->score = $score;
        
    }

    public function getEvIdentifier():string
    {
        return $this->evIdentifier;
    }

    public function setEvIdentifier(string $evIdentifier): void
    {
         $this->evIdentifier = $evIdentifier;
    }

    public function setTypeEv(string $typeEv):void
    {
        $this->typeEv = $typeEv;
        
    }

    public function getTypeEv(): string
    {
        return   $this->typeEv;
    }

    public function setScore(float $score):void
    {   
        $this->score = $score;
    }

    public function getScore(): float
    {
        return   $this->score;
    }

}
<?php
declare(strict_types=1);
namespace App\Model\SemesterM;


class McourseData 
{
    private string $lessonLabel;
    private int $credit;
    private array $evaluations;
    private string $courseColor;


    public function __construct(string $lessonLabel, int $credit, string $courseColor)
    {
        $this->lessonLabel = $lessonLabel;
        $this->credit = $credit;
        $this->courseColor = $courseColor;
        $this->evaluations = [];
    }

    public function getLessonLabel(): string{
        return $this->lessonLabel;
    }

    public function getCredit(): int{
        return $this->credit;
    }
    public function getCourseColor(): string{
        return $this->courseColor;
    }

    public function getEvaluations():array{
        return $this->evaluations;
    }


    public function addEvaluation(MEvaluation $evaluation){
        $this->evaluations[] = $evaluation;
    }

}


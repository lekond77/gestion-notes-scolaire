<?php

declare(strict_types=1);

namespace App\Model\SemesterM;

use App\Lib\DatabaseConnection;

class Note
{

    public DatabaseConnection  $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }


    public function displayNotes($login): ?array
    {

        $query = "SELECT *
        FROM  EXAM E, COURSE C WHERE(student =:email AND E.course = C.courseNum);";

        $statement = $this->connection->getConnection()->prepare($query);

        $statement->execute(['email' => $login]);

        $rows =  $statement->fetchAll(\PDO::FETCH_ASSOC);
        $data = [];

        foreach ($rows as $row) {
            $semester = $row['semester'];
            $course = $row['course'];

            if (!isset($data[$semester])) {
                $data[$semester] = new Semester($semester);
            }

            $courseData = $data[$semester]->getCourseData($course);

            if ($courseData === null) {
                $courseData = new McourseData($row['courseName'], (int)$row['coefficient'], $row['courseColor']);
                $data[$semester]->addCourseData($course, $courseData);
            }

            $evaluation = new MEvaluation($row['evaluation'], (float)$row['note']);
            $courseData->addEvaluation($evaluation);
        }

        return $data;
    }
}

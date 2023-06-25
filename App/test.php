<?php 


//Pour inclure plusieurs classes a la fois 

$table = [
    ['course' => 'course1',
    'courseName' => 'Math',
     'evaluation' => 'ev1',
     'semester' => 'semestre1',
     'coef' => 3,
      'note' => 16 
    ],
    ['course' => 'course1',
    'courseName' => 'Math',
    'evaluation' => 'ev2',
    'semester' => 'semestre1',
    'coef' => 3,
    'note' => 10 
    ],
    ['course' => 'course1',
        'courseName' => 'MATH',
    'evaluation' => 'ev3',
    'semester' => 'semestre2',
    'coef' => 4,
    'note' => 14
    ],
    ['course' => 'course2',
    'courseName' => 'PCT',
    'evaluation' => 'ev1',
    'semester' => 'semestre1',
    'coef' => 1,
    'note' => 10 
    ],
    ['course' => 'course3',
'courseName' => 'SVT',
'evaluation' => 'ev1',
'semester' => 'semestre1',
'coef' => 1,
'note' => 10.5
],

];

/*$key = md5(strval(microtime(TRUE)*100000));

echo $key. "\n";
sleep(1);
$key1 = md5(strval(microtime(TRUE)*100000));
echo $key1 ."\n";*/


$groupedData = [];
foreach ($table as $item) {
    if (!isset($groupedData[$item['semester']])) {
        $groupedData[$item['semester']] = [
            'semester' => $item['semester'],
            'courses' => []
        ];
    }
    if (!isset($groupedData[$item['semester']]['courses'][$item['course']])) {
        $groupedData[$item['semester']]['courses'][$item['course']] = [
            'courseName' => $item['courseName'],
            'coef' => $item['coef'],
            'notes' => [],
            'evaluations' => []
        ];
    }
    $groupedData[$item['semester']]['courses'][$item['course']]['notes'][] = $item['note'];
    $groupedData[$item['semester']]['courses'][$item['course']]['evaluations'][] = $item['evaluation'];
}

print_r($groupedData );
foreach ($groupedData as $semester) {
    echo "Semestre: " . $semester['semester'] . "\n";
    foreach ($semester['courses'] as $course) {
        echo "Matière: " . $course['courseName'] . " Coef: " . $course['coef'] . "\n";
       // print_r( $course['notes'][0] );
       // print_r( $course['evaluations'] );
        for($i = 0; $i < count($course['notes']); $i++){
           echo $course['evaluations'][$i] . ' : ' . $course['notes'][$i] ."\n";
        }
    }
}

class Note{
private int $score;
private string $note;
public function __construct($score, $note)
{
    $this->score = $score;
    $this->note = $note;
}

}

$table = [];
$note1 = new Note(10, "EVA");
$note2 = new Note(10, "EVB");


$table[] = $note1;
$table[] = $note2;

var_dump($table);


$hash =  password_hash("toto", PASSWORD_DEFAULT);
echo $hash . "\n";
$hash = '$2y$10$WAXmxLZNZQZskLrfJcU5benquY2PcNVJVrBxJYv7KXbBjgNjACbrW';

echo (password_verify("toto", $hash))?("Verifié"):("Non vérifié");
echo "\n";

echo urlencode('student@gmail.com');
echo "\n";
echo urlencode('c66db4c1e7d99942d065d8f00882572b');
exit();


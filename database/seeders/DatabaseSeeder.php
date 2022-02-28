<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{
    Course,
    Student,
    University,
    UniversityCourse,
    Registration,
};

class DatabaseSeeder extends Seeder
{
    private $noOfStudents = 150;
    private $noOfUniversities = 15;
    private $noOfRegistrations = 100;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create students
        $students = Student::factory($this->noOfStudents)->create();
        $studentIds = array_column($students->toArray(), 'id');

        // Create universities
        $universities = University::factory($this->noOfUniversities)->create();

        // Get latest course id 
        $latestCourseId = Course::orderBy('id', 'desc')->first();
        $latestCourseId = empty($latestCourseId) ? 0 : $latestCourseId['id'];

        // Create courses
        Course::insertOrIgnore([
            ['name' => 'Electronics and communication Engineering'],
            ['name' => 'Electrical Engineering'],
            ['name' => 'Mechanical engineering'],
            ['name' => 'Information Technology'],
            ['name' => 'Artificial intelligence'],
            ['name' => 'Data Science'],
            ['name' => 'Artificial intelligence and machine learning'],
            ['name' => 'Agriculture Engineering'],
            ['name' => 'Food technology'],
            ['name' => 'Information Science and engineering'],
            ['name' => 'Biomedical Engineering'],
            ['name' => 'Electronics and Instrumentation Engineering'],
            ['name' => 'Mechatronics'],
            ['name' => 'Instrumentation and Control'],
            ['name' => 'Mining Engineering'],
            ['name' => 'Production engineering'],
            ['name' => 'Dairy technology'],
            ['name' => 'Marine Engineering'],
            ['name' => 'Big Data Analytics'],
            ['name' => 'Automation and Robotics'],
            ['name' => 'Petroleum Engineering'],
            ['name' => 'Instrumentation Engineering'],
            ['name' => 'Ceramic Engineering'],
            ['name' => 'Chemical Engineering'],
            ['name' => 'Structural Engineering'],
            ['name' => 'Transportation Engineering'],
            ['name' => 'Construction Engineering'],
            ['name' => 'Power Engineering'],
            ['name' => 'Robotics Engineering'],
            ['name' => 'Textile Engineering'],
            ['name' => 'Smart Manufacturing & Automation'],
            ['name' => 'Aeronautical Engineering'],
            ['name' => 'Automobile Engineering'],
            ['name' => 'Civil Engineering'],
            ['name' => 'Computer Science and Engineering'],
            ['name' => 'Biotechnology Engineering'],
            ['name' => 'Electrical and Electronics Engineering'],
        ]);
        $courses = Course::where('id', '>', $latestCourseId)->get()->toArray();
        $universityCourseMap = [];

        // Map university with courses
        foreach ($universities as $university) {
            $mapCount = rand(2, 30);
            $randomCourseIds = array_rand($courses, $mapCount);

            for ($i = 0; $i < $mapCount; $i++) {
                $universityCourseMap[] = [
                    'university_id' => $university->id,
                    'course_id'     => $courses[$randomCourseIds[$i]]['id']
                ];

                $university->courses()->attach(
                    $courses[$randomCourseIds[$i]]['id'],
                    [
                        'capacity' => rand(1, 10) * 10,
                        'duration_in_months' => rand(1, 6) * 6,
                        'about' => $courses[$randomCourseIds[$i]]['name']
                                    . ' course in '
                                    . $university->name
                    ]
                );
            }
        }

        // Create registrations
        for ($i = 0; $i < $this->noOfRegistrations; $i++) {
            $course = UniversityCourse::where('course_id', $universityCourseMap[$i]['course_id'])
                        ->where('university_id', $universityCourseMap[$i]['university_id'])
                        ->first();

            // Check if capacity of course is full
            if ($course->capacity > count($course->registrations)) {
                $universityCourseMap[$i]['student_id'] = $studentIds[rand(0, count($studentIds) - 1)];

                // Register a student for given course
                Registration::firstOrCreate($universityCourseMap[$i]);
            }
        }
    }
}

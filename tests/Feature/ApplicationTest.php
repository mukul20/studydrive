<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\ModelStructures;
use Illuminate\Support\Facades\Http;

class ApplicationTest extends TestCase
{
    /**
     * This method is called before
     * any test of TestCase class executed
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        // Create test db file if not present
        shell_exec('touch database/database.sqlite');
        shell_exec('php artisan config:cache --env=testing');
        shell_exec('php artisan migrate:refresh');
    }

    /**
     * Test to create course.
     *
     * @return void
     */
    public function test_can_create_course()
    {
        $params = [
            'name'  => 'Test Course'
        ];

        $response = $this->postJson(route('courses.store', $params));
        $response->assertStatus(200);
    }

    /**
     * Test to get list of all courses.
     *
     * @return void
     */
    public function test_can_get_courses()
    {
        $response = $this->getJson(route('courses.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ModelStructures::getStructureFor('course')
            ]
        ]);
    }

    /**
     * Test to create university.
     *
     * @return void
     */
    public function test_can_create_university()
    {
        $params = [
            'name'  => 'Test University'
        ];

        $response = $this->postJson(route('universities.store', $params));
        $response->assertStatus(200);
    }

    /**
     * Test to get list of all universities.
     *
     * @return void
     */
    public function test_can_get_universities()
    {
        $response = $this->getJson(route('universities.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ModelStructures::getStructureFor('university')
            ]
        ]);
    }

    /**
     * Test to create student.
     *
     * @return void
     */
    public function test_can_create_student()
    {
        $params = [
            'name'     => 'Test Student',
            'email'    => 'test@test.com',
            'password' => 'Password@123',
        ];

        $response = $this->postJson(route('students.store'), $params);
        $response->assertStatus(200);
    }

    /**
     * Test to get list of all students.
     *
     * @return void
     */
    public function test_can_get_students()
    {
        $response = $this->getJson(route('students.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ModelStructures::getStructureFor('student')
            ]
        ]);
    }

    /**
     * Test to map university with course.
     *
     * @return void
     */
    public function test_can_map_university_with_course()
    {
        $params = [
            'course_id'          => 1,
            'duration_in_months' => 36,
            'about'              => 'About text',
            'university'         => 1,
            'capacity'           => 1,
        ];

        $response = $this->postJson(
            route('universities.courses.store', $params)
        );

        $response->assertStatus(200);
    }

    /**
     * Test to get university courses.
     *
     * @return void
     */
    public function test_can_get_university_with_course()
    {
        $params = [
            'university' => 1,
        ];

        $response = $this->getJson(
            route('universities.courses.index', $params)
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'courses' => [
                '*' => array_merge(
                    ModelStructures::getStructureFor('course'),
                    ['total_registrations', 'available'],
                    ['details' => ModelStructures::getStructureFor('university_course')],
                )
            ]
        ]);
    }

    /**
     * Test to register a student for a course.
     *
     * @return void
     */
    public function test_can_register_for_a_course()
    {
        $params = [
            'course_id'     => 1,
            'student_id'    => 1,
            'university_id' => 1,
        ];

        //$response = Http::post(route('registrations.store', $params));

        $response = $this->postJson(
            route('registrations.store'),
            $params
        );

        $response->assertStatus(200);
    }

    /**
     * Test to get list of all registrations.
     *
     * @return void
     */
    public function test_can_get_registrations()
    {
        $response = $this->getJson(route('registrations.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ModelStructures::getStructureFor('registration')
            ]
        ]);
    }

    /**
     * Test to get a registration.
     *
     * @return void
     */
    public function test_can_get_a_registration()
    {
        $params = [
            'registration' => 1
        ];

        //$response = Http::post(route('registrations.store', $params));

        $response = $this->getJson(
            route('registrations.show', $params),
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'registered_on',
            'course'     => ModelStructures::getStructureFor('course'),
            'student'    => ModelStructures::getStructureFor('student'),
            'university' => ModelStructures::getStructureFor('university'),
        ]);
    }

    /**
     * Test to delete a registration.
     *
     * @return void
     */
    public function test_can_delete_a_registration()
    {
        $params = [
            'registration' => 1
        ];

        $response = $this->getJson(
            route('registrations.destroy', $params),
        );

        $response->assertStatus(200);
    }
}

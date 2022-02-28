<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $courseId = $this->request->get('course_id');
        $universityId = $this->request->get('university_id');

        return [
            'course_id' => [
                'required',
                'exists:university_courses,course_id,university_id,'.$universityId
            ],

            'student_id' => ['required', 'exists:students,id'],
            
            'university_id' => [
                'required',
                'exists:university_courses,university_id,course_id,'.$courseId
            ],
        ];
    }
}

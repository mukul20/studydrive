<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUniversityCourseRequest extends FormRequest
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
        return [
            'about'              => ['sometimes', 'nullable'],
            'capacity'           => ['required', 'integer'],
            'course_id'          => ['required', 'exists:courses,id'],
            'duration_in_months' => ['required', 'integer'],
            'university_id'      => ['required', 'exists:universities,id'],
        ];
    }

    /**
     * Setup the validation of route parameters.
     *
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all();
        $data['university_id'] = $this->route('university');

        return $data;
    }
}

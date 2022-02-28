<?php

namespace App\Transformers;

class UniversityCourseTransformer
{
	/**
     * Transform university course data.
     *
     * @param  array $university
     * @param  array $registrations
     * @return array
     */
	public static function transform(array $university, array $registrations): array
	{
		$registrationCounts = [];

		foreach ($registrations as $registration) {
			$registrationCounts[$registration['course_id']] = $registration['count'];
		}

		// Attach total_registrations and available params
		foreach ($university['courses'] as $key => $course) {
			$count = $registrationCounts[$course['id']] ?? 0;
			$university['courses'][$key]['total_registrations'] = $count;

			$university['courses'][$key]['available'] =
				$count < $course['details']['capacity'];
		}

		// Return transformed data
		return $university;
	}
}
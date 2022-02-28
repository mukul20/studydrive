<?php
namespace Tests;

use App\Models\{
	Course,
	Registration,
	Student,
	University,
	UniversityCourse,
};

class ModelStructures
{
	/**
     * Get all attributes of a model by model name
     *
     * @param  string $modelName
     * @return array  $attributes
     */
	public static function getStructureFor($modelName) : array
	{
		switch($modelName) {
			case 'course':
				$model = new Course();
				break;

			case 'registration':
				$model = new Registration();
				break;

			case 'student':
				$model = new Student();
				break;

			case 'university':
				$model = new University();
				break;

			case 'university_course':
				$model = new UniversityCourse();
				break;

			default:
				return [];
		}

		return self::getAllAttributes($model);
	}

	/**
     * Get all attributes of a model
     *
     * @param  App\Model $model
     * @return array 	 $attributes
     */
	private static function getAllAttributes($model) : array
	{
		$attributes = array_merge(
			$model->getFillable(),
			array_keys($model->getcasts())
		);

		$attributes = array_diff(
			$attributes,
			$model->getHidden()
		);

		return array_unique($attributes);
	}
}
<?php
/**
 * @package     RZ\Package\Utility\Tests\String
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\Utility\Tests\String;

use PHPUnit\Framework\TestCase;
use Webmasterskaya\Utility\String\CasesHelper;

class CasesHelperTest extends TestCase
{
	private array $input
		= [
			'camelCaseString',
			'PascalCaseString',
			'snake_case_string',
			'kebab-case-string',
			'dotted.case.string',
			'mixed.caseWith123-Numbers_string',
			'321-with.start_numbers.inString',
		];

	public function testDottedize()
	{
		$expected_result = [
			'camel.case.string',
			'pascal.case.string',
			'snake.case.string',
			'kebab.case.string',
			'dotted.case.string',
			'mixed.case.with123.numbers.string',
			'321.with.start.numbers.in.string',
		];

		$this->testEquals('dottedize', $expected_result);
	}

	public function testSnakeize()
	{
		$expected_result = [
			'camel_case_string',
			'pascal_case_string',
			'snake_case_string',
			'kebab_case_string',
			'dotted_case_string',
			'mixed_case_with123_numbers_string',
			'321_with_start_numbers_in_string',
		];

		$this->testEquals('snakeize', $expected_result);
	}

	public function testKebabize()
	{
		$expected_result = [
			'camel-case-string',
			'pascal-case-string',
			'snake-case-string',
			'kebab-case-string',
			'dotted-case-string',
			'mixed-case-with123-numbers-string',
			'321-with-start-numbers-in-string',
		];

		$this->testEquals('kebabize', $expected_result);
	}

	public function testClassify()
	{
		$expected_result = [
			'CamelCaseString',
			'PascalCaseString',
			'SnakeCaseString',
			'KebabCaseString',
			'DottedCaseString',
			'MixedCaseWith123NumbersString',
			'WithStartNumbersInString',
		];

		$this->testEquals('classify', $expected_result);
	}

	public function testLowerCamelize()
	{
		$expected_result = [
			'camelCaseString',
			'pascalCaseString',
			'snakeCaseString',
			'kebabCaseString',
			'dottedCaseString',
			'mixedCaseWith123NumbersString',
			'321WithStartNumbersInString',
		];

		$this->testEquals('camelize', $expected_result);
	}

	public function testUpperCamelize()
	{
		$expected_result = [
			'CamelCaseString',
			'PascalCaseString',
			'SnakeCaseString',
			'KebabCaseString',
			'DottedCaseString',
			'MixedCaseWith123NumbersString',
			'321WithStartNumbersInString',
		];

		foreach ($this->input as $i => $value)
		{
			$this->assertEquals($expected_result[$i], CasesHelper::camelize($value, true));
		}
	}

	private function testEquals($method, array $expected): void
	{
		foreach ($this->input as $i => $value)
		{
			$this->assertEquals($expected[$i], call_user_func([CasesHelper::class, $method], $value));
		}
	}
}

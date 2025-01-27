<?php

namespace Glhd\Linen\Tests\Feature;

use Glhd\Linen\CsvReader;
use Glhd\Linen\Tests\TestCase;

class CsvReaderTest extends TestCase
{
	public function test_it_can_read_a_basic_csv_file_as_an_iterator(): void
	{
		$reader = CsvReader::from($this->fixture('basic.csv'));
		
		foreach ($reader as $index => $row) {
			$this->assertSame(match ($index) {
				0 => ['user_id' => 1, 'name' => 'Chris', 'nullable' => null, 'number' => 40.2],
				1 => ['user_id' => 10, 'name' => 'Bogdan', 'nullable' => 'not null', 'number' => -37],
			}, $row->toArray());
		}
	}
	
	public function test_it_can_read_a_basic_csv_file_as_a_collection(): void
	{
		$collection = CsvReader::from($this->fixture('basic.csv'))->collect();
		
		foreach ($collection as $index => $row) {
			$this->assertSame(match ($index) {
				0 => ['user_id' => 1, 'name' => 'Chris', 'nullable' => null, 'number' => 40.2],
				1 => ['user_id' => 10, 'name' => 'Bogdan', 'nullable' => 'not null', 'number' => -37],
			}, $row->toArray());
		}
	}
}

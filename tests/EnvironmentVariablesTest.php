<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LimIndustries\EnvironmentVariables\EnvironmentVariables;

final class EnvironmentVariablesTest extends TestCase
{
    public function testCanUseEnvironmentVariables(): void
    {
        EnvironmentVariables::getInstance(__DIR__ . DIRECTORY_SEPARATOR . '.env');
		$this->assertEquals('testing', getenv('TEST'));
    }

    public function testCanImportVariables(): void
    {
        EnvironmentVariables::importVariables(__DIR__ . DIRECTORY_SEPARATOR . '.env');
		$this->assertEquals('testing', getenv('TEST'));
    }

    public function testCanLoadFile(): void
    {
        $this->assertEquals(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '.env'), 
            EnvironmentVariables::loadFile(__DIR__ . DIRECTORY_SEPARATOR . '.env')
        );
    }

    public function testCanAssignVariables(): void
    {
        EnvironmentVariables::assignVariables('TEST2=testing2');
        $this->assertEquals('testing2', getenv('TEST2'));
    }

    // public function testCanFail(): void
    // {
	// 	$this->assertEquals(false, true);
    // }
}
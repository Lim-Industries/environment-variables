<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class EnvironmentVariablesTest extends TestCase
{
    public function testCanUseEnvironmentVariables(): void
    {
        $simple = new EnvironmentVariables(__DIR__ . DIRECTORY_SEPARATOR . '.env');

		$this->assertEquals('testing', getenv('TEST'));
    }

    public function testCanLoadFile(): void
    {
        $class = new EnvironmentVariables();
        $this->assertEquals(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '.env'), 
            $class->loadFile(__DIR__ . DIRECTORY_SEPARATOR . '.env')
        );
    }

    public function testCanAssignVariables(): void
    {
        $class = new EnvironmentVariables();
        $class->assignVariables('TEST2=testing2');
        $this->assertEquals('testing2', getenv('TEST2'));
    }
}
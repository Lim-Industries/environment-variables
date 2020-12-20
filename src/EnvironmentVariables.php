<?php declare(strict_types=1);
/**
 * Sets environment variables from a .env file.
 * 
 * @category Configuration
 * @package  Milim
 * @author   Andrew Lim <andrew@limindustries.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://limindustries.com
 */
class EnvironmentVariables
{
    /**
     * Checks to see if the .env exists and parses it to set the 
     * evironment variables.
     * 
     * @param [type] $file
     * @return void
     */
    public function __construct($file) 
    {
        $contents = $this->loadFile($file);
        if ($contents) {
            $this->assignVariables($contents);
        }
    } 

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public function loadFile($file)
    {
        try {
            // run your code here
            return file_get_contents($file);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $contents
     * @return void
     */
    public function assignVariables($contents)
    {
        $variables = explode(PHP_EOL, $contents);
        $variables = array_filter($variables);
        foreach ($variables as $variable) {
            $keyValue = explode('=', $variable);
            putenv($keyValue[0] . "=" . trim($keyValue[1]));
        }
    }

    // asign vars
    // load file
}

// new EnvironmentVariables();
// echo getenv('APP_ENV');
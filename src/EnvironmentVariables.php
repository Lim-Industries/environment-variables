<?php
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
     * @return void
     */
    public function __construct() 
    {
        if (file_exists('./.env')) {
            $env = file_get_contents('./.env');
            $variables = explode(PHP_EOL, $env);
            $variables = array_filter($variables);
        
            foreach ($variables as $variable) {
                $keyValue = explode('=', $variable);
                putenv($keyValue[0] . "=" . trim($keyValue[1]));
            }
        }
    } 
}

// new EnvironmentVariables();
// echo getenv('APP_ENV');
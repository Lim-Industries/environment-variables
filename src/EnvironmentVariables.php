<?php declare(strict_types=1);
/*
 * This file is part of lim-industries/environment-variables.
 *
 * (c) Andrew Lim <andrew@limindustries.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace LimIndustries\EnvironmentVariables;

class EnvironmentVariables
{
    // Hold the class instance.
    private static $instance = null;

    /**
     * Checks to see if the .env exists and parses it to set the 
     * evironment variables.
     * 
     * @param [type] $file
     * @return void
     */
    private function __construct($file = null) 
    {
        $this->importVariables($file);
    }

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public static function getInstance($file = null)
    {
        if (self::$instance == null) {
            self::$instance = new EnvironmentVariables($file);
        }
        return self::$instance;
    }

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public static function importVariables($file) {
        if ($file) {
            $contents = self::loadFile($file);
            self::assignVariables($contents);
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public static function loadFile($file)
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
    public static function assignVariables($contents)
    {
        $variables = explode(PHP_EOL, $contents);
        $variables = array_filter($variables);
        foreach ($variables as $variable) {
            if (self::validate($variable)) { 
                $keyValue = explode('=', $variable);
                $value = trim($keyValue[1]);

                switch ($value) {
                    case "false":
                        $value = '';
                        break;
                    default:
                        break;
                }

                putenv($keyValue[0] . "=" . $value);
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $string
     * @return void
     */
    private static function validate($string)
    {
        if (substr($string, 0, 1) === "#") {
            // If starts with #
            return false;
        } else if (strpos($string, '=') === false) {
            // If not a key pair
            return false;
        } else {
            $keyValue = explode('=', $string);
            if (getenv($keyValue[0]) != null) {
                // If already exists
                return false;
            }
        }

        return true;
    }

    // import vars
}

// EnvironmentVariables::getInstance(__DIR__ . DIRECTORY_SEPARATOR . '.env');
// echo getenv('APP_ENV');
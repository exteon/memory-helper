<?php
    /**
     * This helper class is used to perform some common PHP memory management
     * operations
     *
     * @package Exteon\MemoryHelper
     */

    namespace Exteon;

    /**
     * This helper class is used to perform some common PHP memory management
     * operations
     */
    abstract class MemoryHelper {

        /**
         * Gets the current memory limit, in bytes
         *
         * @return int
         */
        static function getMemoryLimit(): int {
            return static::bytesFromPhpIniString(ini_get('memory_limit'));
        }

        /**
         * Increases memory limit by the specified amount
         *
         * @param string $amount
         */
        static function increaseMemoryLimit(string $amount): void {
            $memory = static::getMemoryLimit();
            if ($memory < 0) {
                return;
            }
            ini_set(
                'memory_limit',
                $memory + static::bytesFromPhpIniString($amount)
            );
        }

        /**
         * Sets the memory limit for the PHP script
         *
         * @param string $amount
         */
        static function setMemoryLimit(string $amount): void {
            ini_set('memory_limit', static::bytesFromPhpIniString($amount));
        }

        /**
         * Runs the supplied callback with an increased memory limit
         *
         * @param string $amount
         * @param callable $callback
         * @return mixed
         */
        static function doWithIncreasedMemory(
            string $amount,
            callable $callback
        ) {
            $memory = static::getMemoryLimit();
            if ($memory >= 0) {
                $bytes = static::bytesFromPhpIniString($amount);
                if ($bytes < 0) {
                    ini_set('memory_limit', $amount);
                } else {
                    ini_set('memory_limit', $memory + $bytes);
                }
            }
            $result = $callback();
            if ($memory >= 0) {
                static::setMemoryLimit($memory);
            }

            return $result;
        }

        /**
         * Parses the value in Php .ini memory size format (i.e. '100M') into
         * the numeric byte size
         *
         * @param string $val
         * @return int
         */
        static function bytesFromPhpIniString(string $val): int {
            $val = trim($val);
            $term = substr($val, -1);
            if (preg_match('`^\\D$`', $term)) {
                $val = substr($val, 0, strlen($val) - 1);
                $val = (int)$val;
                $term = strtolower($term);
                switch ($term) {
                    case 'g':
                        $val *= 1024 * 1024 * 1024;
                        break;
                    case 'm':
                        $val *= 1024 * 1024;
                        break;
                    case 'k':
                        $val *= 1024;
                        break;
                }
            }

            return $val;
        }
    }
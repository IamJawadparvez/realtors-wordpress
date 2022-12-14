<?php

namespace WPStaging\Framework\Utils;

use WPStaging\Core\WPStaging;

class Sanitize
{
    protected $config = [];

    /**
     * Sanitize string and array. Automatically urldecode
     *
     * @param array|string $value
     * @return array|string
     */
    public function sanitizeString($value)
    {
        if (is_object($value)) {
            return $value;
        }

        $value = wpstg_urldecode($value);
        if (!is_array($value)) {
            return htmlspecialchars($value);
        }

        $sanitized = [];
        foreach ($value as $string) {
            $sanitized[] = is_string($string) ? htmlspecialchars($string) : $string;
        }

        return $sanitized;
    }

    /**
     * @param string $password
     * @return string
     */
    public function sanitizePassword($password)
    {
        if (!is_string($password)) {
            return "";
        }

        return trim(stripslashes($password));
    }

    /**
     * Sanitize integer. Optionally use abs flag
     * @param int|string $value
     * @param bool $useAbsValue
     * @return int
     */
    public function sanitizeInt($value, $useAbsValue = false)
    {
        $integer = filter_var($value, FILTER_VALIDATE_INT);
        if ($useAbsValue) {
            return absint($integer);
        }

        return $integer;
    }

    /**
     * @param int|bool|string $value
     * @return bool
     */
    public function sanitizeBool($value)
    {
        // FILTER_VALIDATE_BOOL is alias of FILTER_VALIDATE_BOOLEAN and was introduced in PHP 8.0 but php.net say that we use the BOOL variant,
        // See if we should use like this or just use the BOOLEAN variant?
        return filter_var($value, defined('FILTER_VALIDATE_BOOL') ? FILTER_VALIDATE_BOOL : FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param string $value
     * @return string
     */
    public function sanitizeEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $value
     * @return string
     */
    public function sanitizeURL($value)
    {
        return sanitize_url($value);
    }

    /**
     * Sanitize the path, remove spaces and trailing slashes
     * @param string $value
     * @return string
     */
    public function sanitizePath($value)
    {
        if (is_array($value) || is_object($value)) {
            return false;
        }

        $value = $this->sanitizeString($value);

        // Remove trailing slashes
        $path = rtrim($value, '/\\');

        // To support network path on windows
        if (WPStaging::isWindowsOs()) {
            return $path;
        }

        // Remove whitespace and spaces
        $path = preg_replace('/\s+/', '', $path);

        // Convert all invalid slashes to one single forward slash
        $replacements = [
            '//' => '/',
        ];

        return strtr($path, $replacements);
    }

    /**
     * This function ensures backwards compatibility with Wordpress prior to the 4.7 release. sanitize_textarea_field
     * was introduced with that version.
     * @param $str
     *
     * @return string
     */
    public function sanitizeTextareaField($str)
    {
        if (function_exists('sanitize_textarea_field')) {
            return sanitize_textarea_field($str);
        } else {
            return sanitize_text_field($str);
        }
    }

    /**
     * Html decode and then sanitize
     *
     * @param string $text
     * @return string
     */
    public function htmlDecodeAndSanitize($text)
    {
        return sanitize_text_field(html_entity_decode($text));
    }

    /**
     * @param array $file
     * @param array
     */
    public function sanitizeFileUpload($file)
    {
        if (!is_array($file)) {
            return null;
        }

        if (!isset($file['tmp_name'])) {
            return null;
        }

        return $file;
    }

    /**
     * @param array|string $htmlPost
     * @return array
     */
    public function sanitizeExcludeRules($htmlPost)
    {
        if (is_object($htmlPost)) {
            return [];
        }

        $decoded = wpstg_urldecode($htmlPost);

        if (!is_array($decoded)) {
            $items = explode(',', $decoded);
        } else {
            $items = $decoded;
        }

        $sanitized = [];
        foreach ($items as $item) {
            $sanitized[] = $this->sanitizeString($item);
        }

        return $sanitized;
    }

    /**
     * @param array $items
     * @return array
     */
    public function sanitizeArrayInt($items)
    {
        // Early bail if not array
        if (!is_array($items) || empty($items)) {
            return [];
        }

        $sanitized = [];
        foreach ($items as $item) {
            $sanitized[] = $this->sanitizeInt($item);
        }

        return $sanitized;
    }

    /**
     * @param array $items
     * @param array $config
     * @return array
     */
    public function sanitizeArray($items, $config = [])
    {
        // Early bail if not array
        if (!is_array($items) || empty($items)) {
            return [];
        }

        $sanitized = [];
        if (!is_array($config) || empty($config)) {
            $config = $this->config;
        } else {
            $this->config = $config;
        }

        foreach ($items as $key => $value) {
            $sanitized[$key] = isset($config[$key]) ? $this->sanitize($value, $config[$key]) : $this->sanitizeString($value);
        }

        return $sanitized;
    }

    /**
     * @param string $text
     * @return string
     */
    public function decodeBase64AndSanitize($text)
    {
        return $this->sanitizeString(base64_decode($text));
    }

    /**
     * @param int|bool|string|array $value
     * @param string $method
     * @return int|bool|string|array
     */
    protected function sanitize($value, $method)
    {
        $methodName = 'sanitize' . ucfirst($method);
        if (!method_exists($this, $methodName)) {
            return $this->sanitizeString($value);
        }

        return $this->{$methodName}($value);
    }
}

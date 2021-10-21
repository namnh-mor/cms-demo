<?php

/**
 * @package    Grav\Common\Language
 *
 * @copyright  Copyright (c) 2015 - 2021 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Common\Language;

/**
 * Class LanguageCodes
 * @package Grav\Common\Language
 */
class LanguageCodes
{
    /** @var array */
    protected static $codes = [
        'en'         => [ 'name' => 'English',                   'nativeName' => 'English' ],
        'ja'         => [ 'name' => 'Japanese',                  'nativeName' => '日本語' ],
        'ko'         => [ 'name' => 'Korean',                    'nativeName' => '한국어' ],
        'vi'         => [ 'name' => 'Vietnamese',                'nativeName' => 'Tiếng Việt' ],
        'zh'         => [ 'name' => 'Chinese (Simplified)',      'nativeName' => '中文 (简体)' ]
    ];

    /**
     * @param string $code
     * @return string|false
     */
    public static function getName($code)
    {
        return static::get($code, 'name');
    }

    /**
     * @param string $code
     * @return string|false
     */
    public static function getNativeName($code)
    {
        if (isset(static::$codes[$code])) {
            return static::get($code, 'nativeName');
        }

        if (preg_match('/[a-zA-Z]{2}-[a-zA-Z]{2}/', $code)) {
            return static::get(substr($code, 0, 2), 'nativeName') . ' (' . substr($code, -2) . ')';
        }

        return $code;
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getOrientation($code)
    {
        return static::$codes[$code]['orientation'] ?? 'ltr';
    }

    /**
     * @param string $code
     * @return bool
     */
    public static function isRtl($code)
    {
        return static::getOrientation($code) === 'rtl';
    }

    /**
     * @param array $keys
     * @return array
     */
    public static function getNames(array $keys)
    {
        $results = [];
        foreach ($keys as $key) {
            if (isset(static::$codes[$key])) {
                $results[$key] = static::$codes[$key];
            }
        }
        return $results;
    }

    /**
     * @param string $code
     * @param string $type
     * @return string|false
     */
    public static function get($code, $type)
    {
        return static::$codes[$code][$type] ?? false;
    }

    /**
     * @param bool $native
     * @return array
     */
    public static function getList($native = true)
    {
        $list = [];
        foreach (static::$codes as $key => $names) {
            $list[$key] = $native ? $names['nativeName'] : $names['name'];
        }

        return $list;
    }
}

<?php
/**
 * Created by WispX.
 * User: WispX <wisp-x@qq.com>
 * Date: 2019-03-20
 * Time: 16:06
 */

namespace Slug\Facade;

use Slug\Facade;

/**
 * Class Slug
 * @package Slug\Facade
 * @see \Slug\Slug
 *
 * @method static \Slug\Slug setConfig(array $config)
 * @method static array|mixed|null getConfig(string $name = '')
 * @method static mixed translate($text)
 * @method static mixed translug($text, $separator = '-')
 */
class Slug extends Facade
{
    protected static function getFacadeAccessor()
    {
        $instanceKey = 'slug';
        if (!isset(self::$resolvedInstance[$instanceKey])) {
            self::$resolvedInstance[$instanceKey] = new \Slug\Slug;
        }

        return $instanceKey;
    }
}

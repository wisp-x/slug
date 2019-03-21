<?php
/**
 * Created by WispX.
 * User: WispX <wisp-x@qq.com>
 * Date: 2019-03-20
 * Time: 10:26
 */

if (! function_exists('slug')) {
    /**
     * @param array $config
     *
     * @return \Slug\Slug
     */
    function slug(array $config = [])
    {
        return \Slug\Facade\Slug::setConfig($config);
    }
}

<?php
/**
 * Created by WispX.
 * User: WispX <wisp-x@qq.com>
 * Date: 2019-03-20
 * Time: 11:29
 */

namespace Slug;

use GuzzleHttp\Client;

/**
 * Class Slug
 *
 * @package Slug
 */
class Slug
{
    /** @var null */
    protected $client = null;

    /** @var array */
    protected $config = [];

    /** @var string */
    protected $separator = '';

    /** @var string */
    protected $baseUri = 'https://openapi.youdao.com';

    /** @var array */
    protected $params = [
        'form' => 'zh-CHS',
        'to' => 'en'
    ];

    /**
     * Slug constructor.
     *
     * @param $config
     */
    public function __construct(array $config = [])
    {
        $this->client = new Client(['base_uri' => $this->baseUri]);
        $this->config = $config;
    }

    /**
     * @param array $config
     *
     * @return $this
     */
    public function setConfig($config = [])
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return array|mixed|null
     */
    public function getConfig($name = '')
    {
        return empty($name) ? $this->config : (isset($this->config[$name]) ? $this->config[$name] : null);
    }

    /**
     * @param $text
     *
     * @return mixed
     * @throws \RuntimeException
     */
    public function translate($text)
    {
        return $this->translation($text);
    }

    /**
     * @param        $text
     * @param string $separator
     *
     * @return mixed
     * @throws \RuntimeException
     */
    public function translug($text, $separator = '-')
    {
        $this->separator = $separator;

        return $this->translation($text);
    }

    /**
     * @param $text
     *
     * @return mixed
     * @throws \RuntimeException
     */
    private function translation($text)
    {
        $salt = md5(time());
        $query = [
            'sign' => md5($this->config['appKey'] . $text . $salt . $this->config['appSecret']),
            'appKey' => $this->config['appKey'],
            'salt' => $salt,
            'q' => $text
        ];

        $data = $this->client->post('/api', ['query' => array_merge($this->params, $query)]);
        if (200 !== $data->getStatusCode()) {
            throw new \RuntimeException('Abnormal interface.');
        }

        $response = json_decode($data->getBody()->getContents());
        if (0 === (int)$response->errorCode) {
            if ($this->separator) {
                return str_replace(' ', $this->separator, $this->filter(strtolower($response->translation[0])));
            }

            return $this->filter(ucfirst($response->translation[0]));
        }

        throw new \RuntimeException('Translation of failure.');
    }

    /**
     * @param $string
     *
     * @return string
     */
    private function filter($string)
    {
        return trim(str_replace(PHP_EOL, '', $string));
    }
}

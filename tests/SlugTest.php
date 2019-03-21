<?php
/**
 * Created by WispX.
 * User: WispX <wisp-x@qq.com>
 * Date: 2019-03-20
 * Time: 10:58
 */

use PHPUnit\Framework\TestCase;
use Slug\Slug;
use Slug\Facade\Slug as FacadeSlug;

class SlugTest extends TestCase
{
    private $slug;

    public function __construct()
    {
        parent::__construct();

        $config = [
            'appKey' => 'your appKey',
            'appSecret' => 'your appSecret'
        ];

        $this->slug = new Slug($config);
        // Facade
        FacadeSlug::setConfig($config);
    }

    public function testTranslate()
    {
        $this->assertEquals('Test', $this->slug->translate('测试'));
        $this->assertEquals('Test the', $this->slug->translate('测试 一下'));
        $this->assertEquals('Test article title 2333', $this->slug->translate('测试文章标题 2333'));

        // Facade
        $this->assertEquals('Test', FacadeSlug::translate('测试'));
        $this->assertEquals('Test the', FacadeSlug::translate('测试 一下'));
        $this->assertEquals('Test article title 2333', FacadeSlug::translate('测试文章标题 2333'));
    }

    public function testTranslug()
    {
        $this->assertEquals('test_2333', $this->slug->translug('测试一下 2333', '_'));
        $this->assertEquals('test=2333', $this->slug->translug('测试一下 2333', '='));
        $this->assertEquals('test-😊', $this->slug->translug('测试 😊', '-'));

        // Facade
        $this->assertEquals('test_2333', FacadeSlug::translug('测试一下 2333', '_'));
        $this->assertEquals('test=2333', FacadeSlug::translug('测试一下 2333', '='));
        $this->assertEquals('test-😊', FacadeSlug::translug('测试 😊', '-'));
    }

    public function testSetConfig()
    {
        $testConfig = ['test' => 2333];
        $this->slug->setConfig($testConfig);

        $this->assertEquals($testConfig, $this->slug->getConfig());

        // Facade
        FacadeSlug::setConfig($testConfig);
        $this->assertEquals($testConfig, FacadeSlug::getConfig());
    }

    public function testGetConfig()
    {
        $testConfig = ['test' => 2333];
        $this->slug->setConfig($testConfig);
        $this->assertEquals(2333, $this->slug->getConfig('test'));

        // Facade
        FacadeSlug::setConfig($testConfig);

        $this->assertEquals(2333, FacadeSlug::getConfig('test'));
    }

    public function testSlug()
    {
        $testConfig = ['test' => 2333];
        $this->assertEquals(FacadeSlug::setConfig($testConfig), \slug()->setConfig($testConfig));
    }
}

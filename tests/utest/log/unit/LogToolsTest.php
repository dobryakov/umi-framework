<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

namespace utest\log\unit;

use umi\log\exception\OutOfBoundsException;
use umi\log\toolbox\LogTools;
use utest\log\LogTestCase;

/**
 * Тесты инструментов логирования
 */
class LogToolsTests extends LogTestCase
{
    /**
     * @var LogTools $loggerTools
     */
    protected $loggerTools;

    protected function setUpFixtures()
    {
        $this->loggerTools = new LogTools();
        $this->resolveOptionalDependencies($this->loggerTools);
    }

    public function testArrayConfigLogger()
    {
        $this->loggerTools->options = [];
        $logger = $this->loggerTools->getService('umi\log\ILogger', null);
        $this->assertInstanceOf(
            'umi\log\ILogger',
            $logger,
            'Ожидается, что ILoggerTools::getLogger() вернет ILogger'
        );
        $this->assertTrue(
            $logger === $this->loggerTools->getService('umi\log\ILogger', null),
            'Ожидается, что у инструментария логирования только один логер'
        );
    }

    /**
     * @test
     * @expectedException OutOfBoundsException
     */
    public function testWrongConfig()
    {
        $this->loggerTools->type = 'WrongConfig';
        $this->loggerTools->getService('umi\log\ILogger', null);;
    }
}
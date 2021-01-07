<?php
declare(strict_types=1);

namespace Serato\SwsSdk\Test;

use Serato\SwsSdk\Test\AbstractTestCase;
use Serato\SwsSdk\CommandBasicAuth;

class CommandBasicAuthTest extends AbstractTestCase
{
    /** @var mixed */
    private $commandMock;

    public function testCommandHeaders(): void
    {
        $this->createCommandBasicAuthMock();

        $this->commandMock->expects($this->any())
            ->method('getHttpMethod')
            ->willReturn('GET');
        $this->commandMock->expects($this->any())
            ->method('getUriPath')
            ->willReturn('/some/path');
        $this->commandMock->expects($this->any())
            ->method('getArgsDefinition')
            ->willReturn([]);

        $request = $this->commandMock->getRequest();

        $this->assertRegExp('/Basic/', $request->getHeaderLine('Authorization'));
    }

    /**
     * @return void
     */
    private function createCommandBasicAuthMock(): void
    {
        $this->commandMock = $this->getMockForAbstractClass(
            CommandBasicAuth::class,
            [
                'my_app',
                'my_pass',
                'http://my.server.com',
                []
            ]
        );
    }
}

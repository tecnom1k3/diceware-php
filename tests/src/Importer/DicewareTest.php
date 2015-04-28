<?php
namespace AcmeTest\Importer;

use \TestCase;
use \ReflectionClass;
use Acme\Importer\Diceware;

class DicewareTest extends TestCase
{
    public function testImport()
    {
        $dicewareList = 'foo';
        $mock = $this->getMock('Acme\Importer\Diceware', [
             'getFromWeb',
             'saveToDisk',
            ], [], '', false);
        $mock->expects($this->once())->method('getFromWeb')->will($this->returnValue($dicewareList));
        $mock->expects($this->once())->method('saveToDisk')->with($dicewareList);
        $mock->import();
    }
    
    public function testGetFromWeb()
    {
        $body = 'foo';
        $responseMock = $this->getMock('GuzzleHttp\Message\Response', [
            'getBody',
            ], [], '', false);
        $responseMock->expects($this->once())->method('getBody')->will($this->returnValue($body));
        $clientMock = $this->getMock('GuzzleHttp\Client', [
            'get',
            ], [], '', false);
        $clientMock->expects($this->once())->method('get')->with(Diceware::DICEWARE_URL)->will($this->returnValue($responseMock));
        $mock = $this->getMock('Acme\Importer\Diceware', [
            'getHttpClient',
            ], [], '', false);
        $mock->expects($this->once())->method('getHttpClient')->will($this->returnValue($clientMock));
        $this->invoke($mock, 'getFromWeb', []);
    }
    
    public function testSaveToDisk()
    {
        $data = 'foo';
        $fileSystem = $this->getMock('Illuminate\Filesystem\Filesystem');
        $fileSystem->expects($this->once())->method('put')->with(Diceware::DICEWARE_FILE, $data);
        
        $fsFactory = $this->getMock('Illuminate\Contracts\Filesystem\Factory');
        $fsFactory->expects($this->once())->method('disk')->with('local')->will($this->returnValue($fileSystem));
        
        $mock = $this->getMock('Acme\Importer\Diceware', [
            'getFsFactory',
            ], [], '', false);
        $mock->expects($this->once())->method('getFsFactory')->will($this->returnValue($fsFactory));
        $this->invoke($mock, 'saveToDisk', [$data]);
    }
    
    protected function invoke($class, $method, $args)
    {
        $classRef = new ReflectionClass($class);
        $method = $classRef->getMethod($method);
        $method->setAccessible(true);
        return $method->invokeArgs($class, $args);
    }
}
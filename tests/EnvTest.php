<?php declare(strict_types=1);

namespace Arcesilas\Env\Tests;

use Arcesilas\Env\Env;
use PHPUnit\Framework\TestCase;

class EnvTest extends TestCase
{
    use \phpmock\phpunit\PHPMock;

    public function testGet()
    {
        putenv("foo=\"Some string\"");
        $this->assertSame(Env::get('foo'), 'Some string');
    }

    public function trueProvider()
    {
        return [
            ['true'], ['TRUE'], ['True'],
            ['yes'], ['YES'], ['Yes'],
            ['on'], ['ON'], ['On']
        ];
    }

    /**
     * @dataProvider trueProvider
     */
    public function testTrue($value)
    {
        putenv("foo=$value");
        $this->assertTrue(Env::get('foo'));
    }

    public function falseProvider()
    {
        return [
            ['false'], ['FALSE'], ['False'],
            ['no'], ['NO'], ['No'],
            ['off'], ['OFF'], ['Off']
        ];
    }

    /**
     * @dataProvider falseProvider
     */
    public function testFalse($value)
    {
        putenv("foo=$value");
        $this->assertFalse(Env::get('foo'));
    }

    public function nullProvider()
    {
        return [
            ['null'],
            ['NULL'],
            ['Null']
        ];
    }

    /**
     * @dataProvider nullProvider
     */
    public function testNull($value)
    {
        putenv("foo=$value");
        $this->assertNull(Env::get('foo'));
    }

    public function testInteger()
    {
        putenv("foo=42");
        $this->assertIsInt(Env::get('foo'));
    }

    public function testFloat()
    {
        putenv("foo=3.14");
        $this->assertIsFloat(Env::get('foo'));
    }

    public function testDefault()
    {
        $this->assertSame(null, Env::get('bar'));
        $this->assertSame(42, Env::get('bar', 42));
        $this->assertSame(42, ENV::get('bar', function () {return 42;}));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetLocal()
    {
        // Mock the getenv function with phpmock in Env class' namespace
        $getenv = $this->getFunctionMock('Arcesilas\\Env\\', 'getenv');
        $getenv->expects($this->once())
            ->with($this->equalTo('foo'), $this->equalTo(true))
            ->willReturn(false);

        Env::getLocal('foo');
    }
}

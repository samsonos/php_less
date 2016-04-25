<?php
/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>.
 * on 20.02.16 at 14:39
 */
namespace samsonphp\less\tests;

use samsonframework\view\Generator;
use test\view\FormView;
use test\view\ItemView;
use test\view\SubItemView;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerator()
    {
        $generator = new Generator(new \samsonphp\generator\Generator(), '\test\view\\');

        $generator->scan(__DIR__ . '/product');
        $generator->generate(__DIR__ . '/generated');

        require 'generated/test/view/FormView.php';

        $output = (new FormView())
            ->product(new \samsonframework\view\tests\TestObject())
            ->surname('MMMM')
            ->email('sdfsdf')
            ->number(1)
            ->places(array(1))
            ->output();

        $this->assertTrue(strpos($output, 'Name') > 0);
    }

    public function testExtend()
    {
        $generator = new Generator(new \samsonphp\generator\Generator(), '\test\view\\');

        $generator->scan(__DIR__ . '/extend');
        $generator->generate(__DIR__ . '/generated');

        require_once 'generated/test/view/IndexView.php';
        require_once 'generated/test/view/ItemView.php';
        $string = (new ItemView())->title('innerTitle')->parentTitle('parent title')->output();
        $this->assertTrue(strpos($string, 'This is regular block parent title') !== false);
        require_once 'generated/test/view/SubItemView.php';

        $string = (new SubItemView())
            ->title('innerTitle')
            ->parentTitle('parent title')
            ->subTitle('subitem block')
            ->output();
        $this->assertTrue(strpos($string, 'This is block - subitem block') !== false);
        $this->assertTrue(strpos($string, 'This is second block - subitem block') !== false);

    }

    public function testKeywordException()
    {
        $this->setExpectedException('\samsonframework\view\exception\GeneratedViewPathHasReservedWord');
        $generator = new Generator(new \samsonphp\generator\Generator(), '\test\view\\');

        $generator->scan(__DIR__);
        $generator->generate(__DIR__ . '/generated');
    }

    public function testHash()
    {
        $generator = new Generator(new \samsonphp\generator\Generator(), '\test\view\\');
        $generator->scan(__DIR__);
        $this->assertTrue(strlen($generator->hash()) > 0);
    }
}

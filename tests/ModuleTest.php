<?php
/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>.
 * on 20.02.16 at 14:39
 */
namespace samsonphp\less\tests;

use samsonphp\less\Module;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerator()
    {
        $module = new Module();

        $module->prepare();

        $module->renderer('css', '.class {}');
    }
}

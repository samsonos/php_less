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

        $content = <<<'LESS'
.parentClass {
    color:green;
    &.blue {
    color:blue;
    }
    .nestedClass{
        border:1px solid;
    }
}
LESS;
        $equals = <<<'CSS'
.parentClass {
  color: green;
}
.parentClass.blue {
  color: blue;
}
.parentClass .nestedClass {
  border: 1px solid;
}

CSS;

        $module->renderer('css', $content);

        $this->assertEquals($equals, $content);
    }
}

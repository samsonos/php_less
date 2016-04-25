<?php
namespace samsonphp\less;

use samson\resourcer\ResourceRouter;
use samsonframework\core\LoadableInterface;
use samsonphp\event\Event;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * SamsonPHP LESS compiler module.
 *
 * @author Vitaly Iegorov <egorov@samsonos.com>
 * @author Nikita Kotenko <kotenko@samsonos.com>
 */
class Module implements LoadableInterface
{
    /** @var \lessc LESS compiler */
    protected $less;

    /** SamsonFramework load preparation stage handler */
    public function prepare()
    {
        Event::subscribe(ResourceRouter::EVENT_CREATED, array($this, 'renderer'));

        $this->less = new \lessc;

        return true;
    }

    /**
     * New resource file update handler.
     *
     * @param string $type    Resource type(extension)
     * @param string $content Resource content
     * @param string $file    LESS file path
     *
     * @throws \Exception
     */
    public function renderer($type, &$content, $file = '')
    {
        // If CSS resource has been updated
        if ($type === 'css') {
            try {
                // Read updated CSS resource file and compile it
                $content = $this->less->compile($content);
            } catch (\Exception $e) {
                //$errorFile = 'cache/error_resourcer'.microtime(true).'.less';
                //file_put_contents($errorFile, $content);
                throw new \Exception('Failed compiling LESS['.$file.']:'."\n".$e->getMessage());
            }
        }
    }
}

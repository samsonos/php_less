<?php
namespace samsonphp\less;

use samson\resourcer\ResourceRouter;
use samsonframework\core\LoadableInterface;
use samsonphp\event\Event;

/**
 * SamsonPHP LESS compiler module.
 *
 * @author Vitaly Iegorov <egorov@samsonos.com>
 * @author Nikita Kotenko <kotenko@samsonos.com>
 */
class Module implements LoadableInterface
{
    /** SamsonFramework load preparation stage handler */
    public function prepare()
    {
        Event::subscribe(ResourceRouter::EVENT_CREATED, array($this, 'renderer'));

        return true;
    }

    /**
     * New resource file update handler.
     *
     * @param string $type Resource type(extension)
     * @param string $content Resource content
     */
    public function renderer($type, &$content)
    {
        // If CSS resource has been updated
        if ($type === 'css') {
            $less = new \lessc;

            // Read updated CSS resource file and compile it
            $content = $less->compile($content);
        }
    }
}

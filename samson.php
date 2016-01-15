<?php
namespace samson\less;

use samson\core\ExternalModule;
use samson\resourcer\ResourceRouter;
use samsonphp\event\Event;

require_once('lessc.php');

/**
 * Интерфейс для подключения модуля в ядро фреймворка SamsonPHP
 *
 * @package SamsonPHP
 * @author Vitaly Iegorov <vitalyiegorov@gmail.com>
 * @author Nikita Kotenko <nick.w2r@gmail.com>
 */
class SamsonLessConnector extends ExternalModule
{
    public function prepare()
    {
        Event::subscribe(ResourceRouter::EVENT_CREATED, array($this, 'renderer'));

        return parent::prepare();
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

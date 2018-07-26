<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

/**
 * Class GravMarkdownGeneratorPlugin
 * @package Grav\Plugin
 */
class MdgenPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [['autoload', 10000]],
        ];
    }
    /**
     * [onPluginsInitialized] Initialize login plugin if path matches.
     * @throws \RuntimeException
     */
    public function autoload()
    {

        // Autoload classes
        $autoload = __DIR__ . '/vendor/autoload.php';

        if (!is_file($autoload)) {
            throw new \RuntimeException('Markdown Generator Plugin failed to load. Composer dependencies not met.');
        }
        require_once $autoload;
        
//        print Generator::generate('example/sample', 'default');
//
//        die();

    }
}

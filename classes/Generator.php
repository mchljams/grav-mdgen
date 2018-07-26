<?php

namespace Grav\Plugin\Mdgen;

use Grav\Common\Page\Page;
use Grav\Common\Filesystem\Folder;
use joshtronic\LoremIpsum;

class Generator
{
    public static function generate($path = null, $template = 'default')
    {
        // use the lorem ipsum library
        $lipsum = new LoremIpsum();
        // throw away word gen, because the first time always starts
        // with 'lorem ipsum', subsequent calls will be random
        $lipsum->words(1);
        // create new page object
        $page = new Page();
        // blank header
        $page->header(['title' => $lipsum->words(4)]);
        // set the full filePath
        $page->filePath('user/pages/' . $path . '/' . $template . $page->extension());
        // Create the markdown from the API
        $page->content(self::requestMarkdown());
        // check if the folder for this page already exists
        if(!$page->folderExists()) {
            // if folder does not exist, then create it
            Folder::create($page->path());
        }
        // check if this page exists already
        if(!$page->exists()) {
            // if the page does not already exist, then create it
            $page->save();
        }
    }

    protected static function requestMarkdown()
    {
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://jaspervdj.be/lorem-markdownum/markdown.txt',
            CURLOPT_USERAGENT => 'Grav Markdown Generator Plugin'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        return $resp;
    }
}
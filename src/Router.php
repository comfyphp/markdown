<?php

namespace ComfyPHP\Markdown;

class Router extends \ComfyPHP\Router
{
    public function fileBasedRouter(): void
    {
        parent::fileBasedRouter();

        $root = $GLOBALS["ROOT"];
        $pathName = $this->getPathName();
        $pagePath = $GLOBALS["CONFIG_PAGE_PATH"];
        $filePath = "";

        // page exist
        if (file_exists("$root/$pagePath/$pathName.md")) {
            $filePath = $pathName;
        }
        // page not exist
        else {
            // page/index exist
            if (file_exists("$root/$pagePath/$pathName/index.md")) {
                $filePath = "$pathName/index";
            } else {
                return;
            }
        }

        $this->all($pathName, $filePath);
        return;
    }
}

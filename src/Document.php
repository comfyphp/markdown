<?php

namespace ComfyPHP\Markdown;

class Document extends \ComfyPHP\Document

{
    protected \ParsedownExtra $parsedown;
    protected array $defaultMDParams = [
        "setBreaksEnabled" => true,
        "setMarkupEscaped" => true,
        "setUrlsLinked" => false,
        "setSafeMode" => true,
    ];
    protected array $MDParams = [];

    public function __construct(array $MDParams = null)
    {
        parent::__construct();
        $this->MDParams = $MDParams;
        $this->parsedown = new \ParsedownExtra();
    }

    public function process(string $view): mixed
    {
        $root = $GLOBALS["ROOT"];
        $parsedown = $this->parsedown;
        $params = $this->MDParams;
        $dfParams = $this->defaultMDParams;
        $pagePath = $GLOBALS["CONFIG_PAGE_PATH"];

        if (file_exists("$root/$pagePath/$view.md")) {
            // get processed markdown
            ob_start();
            include "$root/$pagePath/$view.md";
            $view_content = ob_get_clean();

            // get head
            preg_match('/<head>(.*?)<\/head>/s', $view_content, $head_content);
            $head = isset($head_content[1]) ? $head_content[1] : "";

            // get body
            $body = str_replace($head_content[0], '', $view_content);

            // convert markdown
            $parsedown->setBreaksEnabled($params["setBreaksEnabled"] ?? $dfParams["setBreaksEnabled"]);
            $parsedown->setMarkupEscaped($params["setMarkupEscaped"] ?? $dfParams["setMarkupEscaped"]);
            $parsedown->setUrlsLinked($params["setUrlsLinked"] ?? $dfParams["setUrlsLinked"]);
            $parsedown->setSafeMode($params["setSafeMode"] ?? $dfParams["setSafeMode"]);
            $body = $parsedown->text($body);

            return array(
                "head" => $head,
                "body" => $body,
            );
        }

        return parent::process($view);
    }
}

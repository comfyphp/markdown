# ComfyPHP Markdown Extension

This is an extension for ComfyPHP framework to enable the function of using markdown as a page.

## Before Using it

As this is an extension for ComfyPHP, All dependencies required in ComfyPHP and ComfyPHP itself is needed to use this extension.

## Download / Install

To use this extension, you can install it with Composer.

```bash
composer require comfyphp/markdown
```

## Initialize

Since this extension is based on <a href="https://github.com/erusev/parsedown" target="_blank" rel="noreferrer noopener">Parsedown</a> & <a href="https://github.com/erusev/parsedown-extra" target="_blank" rel="noreferrer noopener">Parsedown Extra</a>, you may pass the configurations which accepted by it.

```php
$config = [
    "setBreaksEnabled" => true,
    "setMarkupEscaped" => true,
    "setUrlsLinked" => false,
    "setSafeMode" => true,
];

// This extension will modify the router and document of ComfyPHP
$router = new ComfyPHP\Router\Markdown();
$document = new ComfyPHP\Document\Markdown($config);
```

Then pass the variables into `ComfyPHP\Core()`:

```php
$core = new ComfyPHP\Core([
    "router" => $router,
    "document" => $document,
]);
```

Create a routing to the target file:

```php
$core->getRouter()->get("/md", "/markdown/index");
```

Or use File-Based Routing if you like:

```php
$core->fileBasedRouter();
```

## Usage

After the initialization, you may create a markdown file in `src/pages` folder (default), let's take `src/pages/markdown/index.md` as the example:

Here we create a heading in the markdown file:

```markdown
# This is My Markdown file {.heading}
```

This will create the HTML below after process:

```html
<h1 class="heading">This is My Markdown file</h1>
```

For more information, you may take a look <a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank" rel="noreferrer noopener">here</a>.

## License

This project is MIT licensed, you can find the license file [here](./LICENSE).

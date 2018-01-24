# Laravel PDF Generator

A Laravel package for generating PDF's by communicating with the PDF Generator API.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

* PHP >=5.6

As this is a private repo, when using composer to require this package - it is assumed your SSH key has already been added to GitHub to authenticate.

### Installing

Start by adding this repo to your projects composer.json file:

```json
{
  "repositories": [
    {
        "type": "vcs",
        "url":  "git@github.com:gatenbysanderson/laravel-pdf-generator.git",
        "no-api": true
    },
    {
        "type": "vcs",
        "url":  "git@github.com:gatenbysanderson/pdf-generator-sdk.git",
        "no-api": true
    }
  ]
}
```

You can then simply require the package as with any other:

```
$ composer require gatenbysanderson/laravel-pdf-generator "~5.1.0"
```

You must then register the service provider and optionally the facade:

```php
// config/app.php

return [

    'providers' => [
        // ...
        GatenbySanderson\LaravelPdfGenerator\Providers\PdfGeneratorServiceProvider::class,
    ],
    
    'aliases' => [
        // ...
        'PDF' => GatenbySanderson\LaravelPdfGenerator\Facades\Pdf::class,
    ],
    
];
```

The `pdf.php` config file must be published from the service provider:

```
$ php artisan vendor:publish --provider="GatenbySanderson\LaravelPdfGenerator\Providers\PdfGeneratorServiceProvider" --tag="config"
```

Finally, the `PDF_URL` must be set in the `.env` file.

_The protocol must be present as well as a trailing slash (e.g. `PDF_URL=http://192.168.0.1/`)._

### Examples

You can now use the container to resolve an instance of the PDF Generator Client for you:

```php
<?php

use GatenbySanderson\LaravelPdfGenerator\PdfGenerator;

// Anywhere
$pdfGenerator = app(PdfGenerator::class);
$response = $pdfGenerator->generate([
    'html_file.html' => '<h1>Hello</h1>',
    'blade_template.blade.php' => view('home'), 
]);

// Controller
public function index(PdfGenerator $pdfGenerator)
{
    $response = $pdfGenerator->generate([
        'html_file.html' => '<h1>Hello</h1>',
        'blade_template.blade.php' => view('home'), 
    ]);
}
```

Or you can optionally use the facade:

```php
<?php

$response = PDF::generate([
    'html_file.html' => '<h1>Hello</h1>',
    'blade_template.blade.php' => view('home'), 
]);
```

### Further Information

This package is simply a wrapper for the PDF Generator SDK which allows blade files to be compiled down to HTML for convenience.
For further information, please see [gatenbysanderson/pdf-generator-sdk](https://github.com/gatenbysanderson/pdf-generator-sdk).

## Running the tests

The code sniffer can be ran as follows:

```
$ composer gscs
```

## Deployment

It's important to remember to use the correct `PDF_URL` for the PDF server in the `.env` file.

## Built With

* [PDF Generator SDK](https://github.com/gatenbysanderson/pdf-generator-sdk) - The SDK to communicate with the PDF Generator API
* [Composer](https://getcomposer.org/) - Dependency management

## Contributing

All changes must be made through the medium of a pull request from the correct release branch.
The branch name represents the Laravel version it is designed for.

1. Create a feature branch off of the `5.1/5.5` branch: `feature/my-awesome-feature`
2. Push your commits to the feature branch
3. Submit a pull request to merge the feature into `5.1/5.5`
4. `5.1/5.5` should then be tagged with a new patch release (i.e. only the last number 5.1.x/5.5.x)


## Versioning

We use a versioning scheme to match the Laravel version supported. For the versions available, see the [tags on this repository](https://github.com/gatenbysanderson/laravel-pdf-generator/tags). 

## License

This project is licensed under the proprietary License.

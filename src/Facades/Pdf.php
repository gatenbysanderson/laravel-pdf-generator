<?php

namespace GatenbySanderson\LaravelPdfGenerator\Facades;

use GatenbySanderson\PdfGeneratorSdk\PdfGenerator;
use Illuminate\Support\Facades\Facade;

class Pdf extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PdfGenerator::class;
    }
}

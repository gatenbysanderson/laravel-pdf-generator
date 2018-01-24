<?php

namespace GatenbySanderson\LaravelPdfGenerator;

use GatenbySanderson\PdfGeneratorSdk\PdfGenerator as PdfGeneratorSdk;
use Illuminate\View\View;

class PdfGenerator
{
    /**
     * @var \GatenbySanderson\PdfGeneratorSdk\PdfGenerator
     */
    protected $pdfGenerator;

    /**
     * PdfGenerator constructor.
     *
     * @param \GatenbySanderson\PdfGeneratorSdk\PdfGenerator $pdfGenerator
     */
    public function __construct(PdfGeneratorSdk $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    /**
     * @param array $files
     * @param array $options
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public function generate(array $files, array $options = []): array
    {
        $files = array_map(function ($file) {
            return ($file instanceof View) ? $file->render() : $file;
        }, $files);

        return $this->pdfGenerator->generate($files, $options);
    }
}

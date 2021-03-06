<?php

namespace GatenbySanderson\LaravelPdfGenerator;

use GatenbySanderson\PdfGeneratorSdk\PdfGenerator as PdfGeneratorSdk;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the config file.
        $this->publishes([
            __DIR__ . '/../config/pdf.php' => config_path('pdf.php')
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the PDF Generator to the container.
        $this->app->bind(PdfGenerator::class, function () {
            $guzzle = new Client(['base_uri' => config('pdf.url')]);
            $pdfGeneratorSdk = new PdfGeneratorSdk($guzzle);
            return new PdfGenerator($pdfGeneratorSdk);
        });
    }
}

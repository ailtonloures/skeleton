<?php

namespace App\Services;

use Dompdf\Dompdf;

final class PDF
{
    /** @var Dompdf */
    protected $pdf;

    /** @var string */
    protected $filename;

    public function __construct(string $filename = 'document.pdf', string $paper = 'A4', string $orientation = 'portrait', $options = null)
    {
        $this->pdf = new Dompdf($options);
        $this->pdf->setPaper($paper, $orientation);
    }

    /**
     * @param mixed $content
     * @return PDF
     */
    public function loadHtml($content): PDF
    {
        $this->pdf->loadHtml($content);
        return $this;
    }

    /**
     * @return void
     */
    public function render(): void
    {
        $this->pdf->render();
        $this->pdf->stream($this->filename, ["Attachment" => false]);
    }

    /**
     * @return void
     */
    public function download(): void
    {
        $this->pdf->render();
        $this->pdf->stream($this->filename);
    }

}

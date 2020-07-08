<?php

namespace App\Services;

use Dompdf\Dompdf;

final class PDF
{
    /** @var Dompdf $pdf */
    protected $pdf;

    /** @var string $fileName */
    protected $fileName;

    public function __construct(string $fileName = 'document.pdf', string $paper = 'A4', string $orientation = 'portrait', $options = null)
    {
        $this->pdf = new Dompdf($options);
        $this->pdf->setPaper($paper, $orientation);

        $this->fileName = $fileName;
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
     * @param string $path
     * @param array $data
     * @return PDF
     */
    public function loadView(string $path, array $data = []): PDF
    {
        $this->pdf->loadHtml(getContent($path, $data));
        return $this;
    }

    /**
     * @return void
     */
    public function render(): void
    {
        $this->pdf->render();
        $this->pdf->stream($this->fileName, ["Attachment" => false]);
    }

    /**
     * @return void
     */
    public function download(): void
    {
        $this->pdf->render();
        $this->pdf->stream($this->fileName);
    }

}

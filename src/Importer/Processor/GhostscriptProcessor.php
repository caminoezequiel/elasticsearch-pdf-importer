<?php

namespace Eze\Elastic\Importer\Processor;

/**
 * Class PdfReduceSizeProcessor
 *
 * This processor reduces the size of a pdf file with Ghostscript command on linux,
 * also converts the pdf color to grayscale to reduces more size.
 *
 * Requirements:
 *  - Ghostscript installed in server (gs command)
 *  - imagemagick intalled in server
 *  - And php need to can run shell_exec function
 *
 * @package Eze\Elastic\Importer\Processor
 */
class GhostscriptProcessor implements ProcessorInterface
{
    /**
     * @param mixed &$data its is with referral for reduce use memory
     * @return mixed
     */
    public function process(&$data)
    {
        $pdf = tempnam("/tmp", "gs_in_");
        $out = tempnam("/tmp", "gs_out_");
        file_put_contents($pdf, $data);
        $data = null; // free memory
        $args = [
            '-sDEVICE=pdfwrite',
            '-dCompatibilityLevel=1.4',
            '-dPDFSETTINGS=/ebook',
            '-dColorConversionStrategy=/Gray',
            '-dProcessColorModel=/DeviceGray',
            '-dNOPAUSE -dQUIET -dBATCH',
            "-sOutputFile={$out} {$pdf}",
        ];
        exec('gs ' . join(' ', $args));
        $data = fread(fopen($out, 'r'), filesize($out));
        unlink($pdf);
        unlink($out);
        return $data;
    }
}

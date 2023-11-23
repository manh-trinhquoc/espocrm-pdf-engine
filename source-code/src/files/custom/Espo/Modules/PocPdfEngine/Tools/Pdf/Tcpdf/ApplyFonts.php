<?php

namespace Espo\Modules\PocPdfEngine\Tools\Pdf\Tcpdf;

use Espo\Core\Container;
use Espo\Core\InjectableFactory;
use Espo\Core\Utils\Metadata;
use Espo\Core\Utils\Resource\PathProvider;
use TCPDF_FONTS;

class ApplyFonts
{
    private $container;

    private $dirPath = 'fonts';

    private $tcpdfFontsDir = 'vendor/tecnickcom/tcpdf/fonts';

    private $fontStyleList = [
        'regular', 'bold', 'italic', 'bolditalic',
    ];

    private $fontStylesMap = [
        'regular' => '',
        'bold' => 'b',
        'italic' => 'i',
        'bolditalic' => 'bi',
    ];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function rebuild(): void
    {
        $fontList = $this->getFileList();

        $fontFaceList = $this->getMetadata()
            ->get(['app', 'pdfEngines', 'Tcpdf', 'fontFaceList']);

        foreach ($fontFaceList as $fontFace) {
            foreach ($this->fontStyleList as $fontStyle) {
                $fontName = $fontFace . '-' . $fontStyle;

                if (empty($fontList[$fontName])) {
                    continue;
                }

                $targetFontPath = $this->tcpdfFontsDir . '/' . $fontFace . $this->fontStylesMap[$fontStyle] . '.php';
                if (file_exists($targetFontPath)) {
                    continue;
                }

                TCPDF_FONTS::addTTFfont(
                    realpath($fontList[$fontName]),
                    'TrueType',
                    '',
                    32,
                    realpath($this->tcpdfFontsDir) . '/',
                    3,
                    1,
                    false,
                    false
                );
            }
        }
    }

    protected function getDirList(): array
    {
        $dirList = [];
        foreach ($this->getMetadata()->getModuleList() as $moduleName) {
            $dirList[] = $this->createPathProvider()->getModule($moduleName) . $this->dirPath;
        }
        $dirList[] = $this->createPathProvider()->getCustom() . $this->dirPath;

        return $dirList;
    }

    protected function getFileList(): array
    {
        $dirList = $this->getDirList();

        $fileList = [];
        foreach ($dirList as $dir) {
            $fontList = scandir($dir);
            foreach ($fontList as $file) {
                if (substr($file, -4) === '.ttf') {
                    $name = mb_strtolower(substr($file, 0, -4));

                    $fileList[$name] = $dir . '/' . $file;
                }
            }
        }

        return $fileList;
    }

    private function getInjectableFactory(): InjectableFactory
    {
        return $this->container->get('injectableFactory');
    }

    private function getMetadata(): Metadata
    {
        return $this->container->get('metadata');
    }

    private function createPathProvider(): PathProvider
    {
        return $this->getInjectableFactory()->create(PathProvider::class);
    }
}

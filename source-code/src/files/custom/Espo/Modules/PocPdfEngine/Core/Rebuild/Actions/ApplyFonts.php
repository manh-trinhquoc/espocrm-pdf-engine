<?php

namespace Espo\Modules\PocPdfEngine\Core\Rebuild\Actions;

use Espo\Core\Application;
use Espo\Core\Rebuild\RebuildAction;

use Espo\Modules\PocPdfEngine\Tools\Pdf\Tcpdf\ApplyFonts as ApplyFontsTool;

class ApplyFonts implements RebuildAction
{
    public function process(): void
    {
        $app = new Application();
        $app->setupSystemUser();

        (new ApplyFontsTool($app->getContainer()))
            ->rebuild();
    }
}

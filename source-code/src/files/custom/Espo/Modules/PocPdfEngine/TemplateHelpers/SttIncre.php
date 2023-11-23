<?php

namespace Espo\Modules\PocPdfEngine\TemplateHelpers;

use Espo\Core\Htmlizer\Helper;
use Espo\Core\Htmlizer\Helper\Data;
use Espo\Core\Htmlizer\Helper\Result;

class SttIncre implements Helper
{
    protected static $current = 0;

    public function __construct(
        // Pass needed dependencies.
    ) {
    }

    public function render(Data $data): Result
    {
        $start = $data->getOption('start');
        if (is_int($start)) {
            static::$current = $start;
        }

        $increase = $data->getOption('increase');
        if (is_int($increase)) {
            static::$current += $increase;
        }

        $get = $data->getOption('get');
        if ($get) {
            return Result::createSafeString(
                static::$current
            );
        }
        // $text = $data->getArgumentList()[0] ?? '';
        return Result::createSafeString(
            ""
        );
    }
}

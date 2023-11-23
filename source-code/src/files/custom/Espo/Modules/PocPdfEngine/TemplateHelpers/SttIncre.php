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

        if ($data->getOption('get')) {
            return Result::createSafeString(
                static::$current
            );
        }

        return Result::createSafeString(
            ""
        );
    }
}

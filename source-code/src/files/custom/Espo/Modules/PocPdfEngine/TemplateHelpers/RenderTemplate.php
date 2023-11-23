<?php

namespace Espo\Modules\PocPdfEngine\TemplateHelpers;

use Espo\Core\Htmlizer\Helper;
use Espo\Core\Htmlizer\Helper\Data;
use Espo\Core\Htmlizer\Helper\Result;

//
use Espo\Core\Htmlizer\TemplateRenderer;
use Espo\Core\Htmlizer\HtmlizerFactory;

use Espo\Core\ApplicationState;
use Espo\Core\ORM\EntityManager;
use Espo\Core\Utils\Util;
use Espo\Core\Api\RequestWrapper;
use Slim\Factory\ServerRequestCreatorFactory;
use Espo\Core\Utils\Route;
use Espo\Tools\Pdf\Data as PdfData;
use Espo\Tools\Pdf\Data\DataLoaderManager;

class RenderTemplate implements Helper
{
    protected static $template;
    protected $templateRenderer;

    public function __construct(
        HtmlizerFactory $htmlizerFactory,
        ApplicationState $applicationState,
        EntityManager $entityManager,
        DataLoaderManager $dataLoaderManager
    ) {

        $requestWrapped = new RequestWrapper(
            ServerRequestCreatorFactory::create()->createServerRequestFromGlobals(),
            Route::detectBasePath()
        );
        $request = $requestWrapped;
        $entityType = $request->getQueryParam('entityType');
        $entityId = $request->getQueryParam('entityId');
        $entity = $entityManager->getEntity($entityType, $entityId);


        $this->templateRenderer = new TemplateRenderer($htmlizerFactory, $applicationState);
        $this->templateRenderer->setEntity($entity);

        $data = PdfData::create()->withAdditionalTemplateData(
            (object) ($additionalData ?? [])
        );
        $data = $dataLoaderManager->load($entity, null, $data);
        $this->templateRenderer->setData($data->getAdditionalTemplateData());
        if (is_null(self::$template)) {
            self::$template = file_get_contents(__DIR__ . "/../PdfTemplate/test.html");
        }
    }

    public function render(Data $data): Result
    {
        $this->templateRenderer->setTemplate(self::$template);
        $html = $this->templateRenderer->render();
        return Result::createSafeString(
            $html
        );
    }
}

<?php

namespace Portal\Factories;

use Portal\Controllers\DeleteStageOptionController;
use Psr\Container\ContainerInterface;

class DeleteStageOptionControllerFactory
{
    /**
     * invoke() method for creating new DeleteStageOptionControllers from the DIC
     * @param ContainerInterface $container
     * @return DeleteStageOptionController
     */
    public function __invoke(ContainerInterface $container):DeleteStageOptionController
    {
        $model = $container->get('StageModel');
        return new DeleteStageOptionController($model);
    }
}

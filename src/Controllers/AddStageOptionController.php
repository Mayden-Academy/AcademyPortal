<?php

namespace Portal\Controllers;

use Portal\Abstracts\Controller;
use Portal\Models\StageModel;

class AddStageOptionController extends Controller
{
    private $stageModel;
    private $options;
    private $stageId;

    public function __construct(StageModel $stageModel)
    {
        $this->stageModel = $stageModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $formOptions = $request->getParsedBody();

        foreach ($formOptions as $option) {
            $this->model->addOption($option);
        }


    
        $this->model->addOptions($this->options);
        
        return $response->withHeader('location', '/displayStages');
    }
}

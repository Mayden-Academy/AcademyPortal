<?php

namespace Portal\Controllers\FrontEnd;

use Portal\Abstracts\Controller;
use Portal\Interfaces\ApplicantModelInterface;
use Portal\Models\ApplicantModel;
use Portal\Models\ApplicationFormModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Portal\Models\StageModel;

class DisplayEditApplicantController extends Controller
{
    private $applicantModel;
    private $applicationFormModel;
    private $renderer;
    private $stageModel;

    /**
     * DisplayEditApplicantController constructor.
     * @param ApplicantModelInterface $applicantModel
     * @param ApplicationFormModel $applicationFormModel
     * @param StageModel $stageModel
     * @param PhpRenderer $renderer
     */
    public function __construct(ApplicantModelInterface $applicantModel, ApplicationFormModel $applicationFormModel, StageModel $stageModel, PhpRenderer $renderer)
    {
        $this->applicantModel = $applicantModel;
        $this->applicationFormModel = $applicationFormModel;
        $this->renderer = $renderer;
        $this->stageModel = $stageModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        if ($_SESSION['loggedIn'] === true) {
            $id = $request->getQueryParams()['id'];
            if ($id > 0) {
                $data['applicant'] = $this->applicantModel->getApplicantById($id);
                $data['stages'] = $this->stageModel->getStageTitles();
                $data['stageOptions'] = $this->stageModel->getStageOptions();
                $data['tasterSessions'] = $this->applicationFormModel->getTasterSessions();
                return $this->renderer->render($response, 'applicantForm.phtml', $data);
            }
            return $response->withHeader('Location', './applicants')->withStatus(400);
        }
        return $response->withStatus(401);
    }
}

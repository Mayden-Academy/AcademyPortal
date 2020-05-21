<?php

namespace Portal\Controllers;

use Portal\Abstracts\Controller;
use Portal\Interfaces\ApplicantModelInterface;
use Portal\Models\ApplicantModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class DisplayEditApplicantController extends Controller
{
    private $applicantModel;
    private $renderer;
    /**
     * DisplayEditApplicantController constructor.
     * @param ApplicantModelInterface $applicantModel
     * @param PhpRenderer $renderer
     */
    public function __construct(ApplicantModelInterface $applicantModel, PhpRenderer $renderer)
    {
        $this->applicantModel = $applicantModel;
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        if ($_SESSION['loggedIn'] === true) {
            $id = $request->getQueryParams()['id'];
            $data['applicant'] = $this->applicantModel->getApplicantById($id);
            $data['title'] = 'Edit Applicant';
            $data['returnUrl'] = './displayApplicants';

            return $this->renderer->render($response, 'applicantForm.phtml', $data);
        }
        return $response->withStatus(401);
    }
}

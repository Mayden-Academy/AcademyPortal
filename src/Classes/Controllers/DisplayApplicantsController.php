<?php

namespace Portal\Controllers;

use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
use Slim\Views\PhpRenderer;
use Portal\Models\ApplicantModel;

class DisplayApplicantsController
{
    private $renderer;
    private $applicantModel;

    /**
     * DisplayApplicantsController constructor.
     *
     * @param PhpRenderer $renderer
     *
     * @param ApplicantModel $applicantModel
     */
    public function __construct(PhpRenderer $renderer, ApplicantModel $applicantModel)
    {
        $this->renderer = $renderer;
        $this->applicantModel = $applicantModel;
    }

    /**
     * Renders applicant data on the front end in displayApplicants.phtml.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return \Psr\Http\Message\ResponseInterface.
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $sortValue = $request->getQueryParam('sort');

        switch ($sortValue){
            case 'dateAsc':
                echo 'date ascending';
                break;

            case 'dateDesc':
                echo 'date descending';
                break;

            case 'cohortAsc':
                echo 'cohort ascending';
                break;

            case 'cohortDesc':
                echo 'cohoert desc';
                break;
        }

        $args['data'] = $this->applicantModel->getAllApplicants();
        return $this->renderer->render($response, 'displayApplicants.phtml', $args);

//        $query = $args['query'];
//        $this->applicantModel->sortApplicants($query);
//        return $response->withRedirect('/displayApplicants');
    }
}

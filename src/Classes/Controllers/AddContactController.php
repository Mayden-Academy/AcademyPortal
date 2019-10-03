<?php


namespace Portal\Controllers;

use Portal\Entities\HiringPartnerEntity;
use Slim\Http\Request;
use Slim\Http\Response;

class AddContactController
{

    private $hiringPartnerModel;

    /**
     * AddContactController constructor.
     * @param $hiringPartnerModel
     */
    public function __construct($hiringPartnerModel)
    {
        $this->hiringPartnerModel = $hiringPartnerModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $newContact = $request->getParsedBody();
        $data = [
            'success' => false,
            'message' => 'Error!',
            'data' => []
        ];
        $statusCode = 400;

        try {
            $contact = $this->hiringPartnerModel->addNewContact(
                $newContact['contactName'],
                $newContact['contactCompanyId'],
                $newContact['contactEmail'],
                $newContact['contactJobTitle'],
                $newContact['contactPhone'],
                $newContact['contactIsPrimary']
            );
            if (!empty($contact) && $contact instanceof HiringPartnerEntity) {
                $result = $this->hiringPartnerModel->addNewContact($contact);
            }
        } catch (\Exception $exception) {
            $data['message'] = $exception->getMessage();
        }
        if (isset($result) && $result) {
            $data = [
                'success' => true,
                'message' => 'Contact information added to the db',
                'data' => []
            ];
            $statusCode = 200;
        }
        return $response->withJson($data, $statusCode);
    }
}
<?php

namespace Portal\Models;

use Portal\Entities\HiringPartnerEntity;

class HiringPartnerModel {

    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /** Inserts the properties to the database
     *
     * @param HiringPartnerEntity $company Sanitise and validate the hiring partner properties as required.
     * @return bool
     */
    public function addHiringPartner(HiringPartnerEntity $company) :bool
    {
        $query = $this->db->prepare("INSERT INTO `hiring_partner_companies` (
            `name`,
            `size`, 
            `tech_stack`,
            `postcode`,
            `phone_number`,
            `url_website`
            )
            VALUES (
            :companyName,
            :companySize,
            :techStack,
            :postcode,
            :phoneNumber,
            :websiteUrl
            );"
        );
        $query->bindParam(':companyName', $company->getCompanyName());
        $query->bindParam(':companySize', $company->getCompanySize());
        $query->bindParam(':techStack', $company->getTechStack());
        $query->bindParam(':postcode', $company->getPostcode());
        $query->bindParam(':phoneNumber', $company->getPhoneNumber());
        $query->bindParam(':websiteUrl', $company->getWebsiteUrl());
        return $query->execute();
    }

    /** Method does a query request that picks up the id and size to be displayed on the dropdown
     *
     * @return array
     */
    public function getCompanySize() :array
    {
        $query = $this->db->prepare("SELECT `id`,`size` FROM `company_sizes`");
        $query->execute();
        return $query->fetchAll();
    }

    /** Instantiate a HiringPartnerEntity
     *
     * @param string $companyName
     * @param string $companySize
     * @param string $techStack
     * @param string $postcode
     * @param string $phoneNumber
     * @param string $websiteUrl
     * @return HiringPartnerEntity
     */
    public function createNewHiringPartner(
        string $companyName,
        string $companySize,
        string $techStack,
        string $postcode,
        string $phoneNumber,
        string $websiteUrl
    ) :HiringPartnerEntity
    {
        return new HiringPartnerEntity(
            $companyName,
            $companySize,
            $techStack,
            $postcode,
            $phoneNumber,
            $websiteUrl
        );
    }

    public function getHiringPartners() {
        $query = $this->db->prepare("SELECT 
	            `id`
				`name`,
	            `size`, 
	            `tech_stack`,
	            `postcode`,
	            `phone_number`,
	            `url_website`
	            FROM `hiring_partner_companies`");
        $query->execute();
        return $query->fetchAll();
    }
}
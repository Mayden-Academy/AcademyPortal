<?php

namespace Tests\ViewHelpers;

use PHPUnit\Framework\TestCase;
use Portal\Entities\BaseApplicantEntity;
use Portal\Entities\ContactEntity;
use Portal\ViewHelpers\DisplayApplicantViewHelper;

class DisplayApplicantViewHelperTest extends TestCase
{
    public function testSuccessDisplayApplicants()
    {
        $expected = '<tr>
                        <td><a data-id ="1" type="button" class="myBtn">Test</a></td>
                            <td>test@test.com</td>
                            <td>Jan 1st</td>
                            <td>Feb 2020</td>
                        </tr>';

        $entityMock = $this->createMock(BaseApplicantEntity::class);
        $entityMock->method('getId')->willReturn(1);
        $entityMock->method('getName')->willReturn('Test');
        $entityMock->method('getEmail')->willReturn('test@test.com');
        $entityMock->method('getDateOfApplication')->willReturn('Jan 1st');
        $entityMock->method('getCohortDate')->willReturn('Feb 2020');

        $data = [$entityMock];
        $result = DisplayApplicantViewHelper::displayApplicants($data);
        $this->assertEquals($expected, $result);
    }

    public function testSuccessDisplayApplicants_EmptyArray()
    {
        $data = [];
        $result = DisplayApplicantViewHelper::displayApplicants($data);
        $this->assertEquals('', $result);
    }

    public function testFailureDisplayApplicants_IncorrectEntityy()
    {
        $mock = $this->createMock(ContactEntity::class);
        $data = [$mock];
        $result = DisplayApplicantViewHelper::displayApplicants($data);
        $this->assertEquals('', $result);
    }
}
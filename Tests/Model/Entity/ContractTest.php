<?php

namespace ACS\ACSPanelBillingBundle\Tests\Model\Entity;

use ACS\ACSPanelBillingBundle\Entity\Contract;

class ContractTest extends \PHPUnit_Framework_TestCase
{
    public function testHasExpired()
    {
        $contract = new Contract();
        $expires = new \DateTime();
        $expires->modify('- 200 days');
        $contract->setExpiresAt($expires);

        $this->assertEquals(true, $contract->hasExpired());

        $expires->modify('+ 200 days');
        $contract->setExpiresAt($expires);

        $this->assertEquals(false, $contract->hasExpired());

        $suposedNewExpiresDate = new \DateTime();
        $suposedNewExpiresDate->modify("+ 363 days");
        $contract = new Contract();
        $expires = new \DateTime();
        $expires->modify('- 2 days');
        $contract->setExpiresAt($expires);
        $contract->setDuration(365);

        $contract->renew();

        $this->assertEquals($suposedNewExpiresDate, $contract->getExpiresAt());
    }
}


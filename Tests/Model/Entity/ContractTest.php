<?php

namespace ACS\ACSPanelBillingBundle\Tests\Model\Entity;

use ACS\ACSPanelBillingBundle\Entity\Contract;

class ContractTest extends \PHPUnit_Framework_TestCase
{
    public function testHasExpired()
    {
        $contract = new Contract();
        $contract->setCreatedAt(\Date('-2 month'));

        $this->assertEquals(true, $contract->hasExpired());

        // milliseconds days * hours * minutes * seconds * milliseconds
        $duration = 30 * 24 * 60 * 60 * 1000;
        $contract->setDuration($duration);

        $this->assertEquals(false, $contract->hasExpired());
    }
}


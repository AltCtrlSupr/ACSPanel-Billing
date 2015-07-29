<?php
namespace ACS\ACSPanelBillingBundle\Tests\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use ACS\ACSPanelBillingBundle\Entity\Contract;

class LoadContractData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Adding 15 contracts for superadmin
        for ($i=0; $i < 15; $i++) {
            $contract = new Contract();
            $contract->setActive(true);
            $contract->setCreatedAt(new \Date());
            $contract->setDuration(365); // One year contract
            $contract->setSeller($this->getReference('user-reseller'));
            $contract->setCustomer($this->getReference('user'));

            $manager->persist($contract);
            $this->addReference('contract-' . $i, $contract);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}


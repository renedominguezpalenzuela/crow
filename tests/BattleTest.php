<?php

namespace App\Tests;

use App\Entity\Troop;
use App\Service\Battle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BattleTest extends KernelTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $battle;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();
        $this->em = $kernel->getContainer()->get('doctrine')->getManager();

        $this->battle = new Battle($this->em);
    }
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null; // avoid memory leaks
    }


       public function testAttackerForceStrenght()
    {

        $tropa1 = array(
            "troops_id"=>1,
            "total"=>103
        );

        $tropa2 = array(
            "troops_id"=>1,
            "total"=>300
        );

        $attacker_troops = array($tropa1, $tropa2);

        $attacker_building_damage_strength = 0;


        $attacking_force_strenght = $this->battle->getAttackerForceStrength($attacker_troops, $attacker_building_damage_strength);
        //165900

        var_dump($attacking_force_strenght);
        $this->assertEquals(165900,   $attacking_force_strenght , "Attacking Force Strenght: ");
       
    }
}

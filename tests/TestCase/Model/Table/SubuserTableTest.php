<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubuserTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubuserTable Test Case
 */
class SubuserTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubuserTable
     */
    public $Subuser;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subuser',
        'app.user',
        'app.answer',
        'app.task',
        'app.category'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subuser') ? [] : ['className' => 'App\Model\Table\SubuserTable'];
        $this->Subuser = TableRegistry::get('Subuser', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subuser);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

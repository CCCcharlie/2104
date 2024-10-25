<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContractorsSkillsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContractorsSkillsTable Test Case
 */
class ContractorsSkillsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContractorsSkillsTable
     */
    protected $ContractorsSkills;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ContractorsSkills',
        'app.Contractors',
        'app.Skills',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ContractorsSkills') ? [] : ['className' => ContractorsSkillsTable::class];
        $this->ContractorsSkills = $this->getTableLocator()->get('ContractorsSkills', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ContractorsSkills);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ContractorsSkillsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ContractorsSkillsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

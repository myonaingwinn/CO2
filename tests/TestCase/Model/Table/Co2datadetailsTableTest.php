<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Co2datadetailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Co2datadetailsTable Test Case
 */
class Co2datadetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\Co2datadetailsTable
     */
    protected $Co2datadetails;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Co2datadetails',
        'app.RoomInfo',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Co2datadetails') ? [] : ['className' => Co2datadetailsTable::class];
        $this->Co2datadetails = $this->getTableLocator()->get('Co2datadetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Co2datadetails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

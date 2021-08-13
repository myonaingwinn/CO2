<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Co2datadetailsHistoryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Co2datadetailsHistoryTable Test Case
 */
class Co2datadetailsHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\Co2datadetailsHistoryTable
     */
    protected $Co2datadetailsHistory;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Co2datadetailsHistory',
        'app.Co2Devices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Co2datadetailsHistory') ? [] : ['className' => Co2datadetailsHistoryTable::class];
        $this->Co2datadetailsHistory = $this->getTableLocator()->get('Co2datadetailsHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Co2datadetailsHistory);

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

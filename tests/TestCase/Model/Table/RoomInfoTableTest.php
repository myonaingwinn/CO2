<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomInfoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomInfoTable Test Case
 */
class RoomInfoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomInfoTable
     */
    protected $RoomInfo;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('RoomInfo') ? [] : ['className' => RoomInfoTable::class];
        $this->RoomInfo = $this->getTableLocator()->get('RoomInfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RoomInfo);

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

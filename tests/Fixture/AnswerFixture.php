<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AnswerFixture
 *
 */
class AnswerFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'answer';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'issued' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'loaded' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'enabled' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'task_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'subuser_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'task_id' => ['type' => 'index', 'columns' => ['task_id'], 'length' => []],
            'subuser_id' => ['type' => 'index', 'columns' => ['subuser_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'answer_ibfk_2' => ['type' => 'foreign', 'columns' => ['subuser_id'], 'references' => ['subuser', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'answer_ibfk_1' => ['type' => 'foreign', 'columns' => ['task_id'], 'references' => ['task', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'issued' => '2016-03-28 07:59:32',
            'loaded' => '2016-03-28 07:59:32',
            'enabled' => 1,
            'task_id' => 1,
            'subuser_id' => 1
        ],
    ];
}

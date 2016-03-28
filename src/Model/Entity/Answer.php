<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $issued
 * @property \Cake\I18n\Time $loaded
 * @property bool $enabled
 * @property int $task_id
 * @property \App\Model\Entity\Task $task
 * @property int $subuser_id
 * @property \App\Model\Entity\Subuser $subuser
 */
class Answer extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}

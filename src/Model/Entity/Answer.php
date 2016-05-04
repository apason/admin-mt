<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity.
 *
 * @property int $id
 * @property int $task_id
 * @property \App\Model\Entity\Task $task
 * @property int $subuser_id
 * @property \App\Model\Entity\Subuser $subuser
 * @property \Cake\I18n\Time $created
 * @property bool $uploaded
 * @property bool $enabled
 * @property string $answer_type
 * @property string $uri
 * @property \App\Model\Entity\Like[] $likes
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

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity.
 *
 * @property int $id
 * @property string $uri
 * @property \Cake\I18n\Time $loaded
 * @property bool $enabled
 * @property int $category_id
 * @property \App\Model\Entity\Category $category
 * @property \Cake\I18n\Time $created
 * @property bool $uploaded
 * @property bool $enabled
 * @property string $name
 * @property string $info
 * @property string $uri
 * @property string $icon_uri
 * @property \App\Model\Entity\Answer[] $answer
 */
class Task extends Entity
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

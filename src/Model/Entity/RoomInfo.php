<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoomInfo Entity
 *
 * @property int $id
 * @property string $device_id
 * @property string $user_uid
 * @property string $postal_code
 * @property string $prefecture
 * @property string $address
 * @property string $room_no
 *
 * @property \App\Model\Entity\Co2datadetail $co2datadetail
 */
class RoomInfo extends Entity
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
        'user_uid' => true,
        'postal_code' => true,
        'prefecture' => true,
        'address' => true,
        'room_no' => true,
        'co2datadetail' => true,
    ];
}

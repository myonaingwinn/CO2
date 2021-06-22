<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Co2datadetail Entity
 *
 * @property string $id
 * @property string|null $co2_device_id
 * @property float|null $temperature
 * @property float|null $humidity
 * @property float|null $co2
 * @property float|null $noise
 * @property \Cake\I18n\FrozenTime|null $time_measured
 *
 * @property \App\Model\Entity\RoomInfo $room_info
 */
class Co2datadetail extends Entity
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
        'co2_device_id' => true,
        'temperature' => true,
        'humidity' => true,
        'co2' => true,
        'noise' => true,
        'time_measured' => true,
        'room_info' => true,
    ];
}

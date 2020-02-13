<?php

namespace Acfabro\RegistrationSiteKit\Entities\Agenda;

use Acfabro\RegistrationSiteKit\Core\Entity\Entity;
use Acfabro\RegistrationSiteKit\Entities\Speaker\Speaker;

/**
 * Class AgendaItem
 *
 * An agenda item
 *
 * @package Acfabro\RegistrationSiteKit\Entities\Agenda
 * @property string $title
 * @property string $description
 * @property Speaker $speaker
 * @property \DateTime $start
 * @property \DateTime $end
 */
class AgendaItem extends Entity
{

}

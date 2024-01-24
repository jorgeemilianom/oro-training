<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;
use Acme\Bundle\DemoBundle\Migrations\Schema\AcmeDemoBundleInstaller;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class AcmeDemoBundle extends AcmeDemoBundleInstaller implements Installation
{
    
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->addDescriptionField($schema);
    }
}
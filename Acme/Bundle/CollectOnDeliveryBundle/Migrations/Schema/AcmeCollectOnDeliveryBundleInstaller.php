<?php

namespace Acme\Bundle\CollectOnDeliveryBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class AcmeCollectOnDeliveryBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createOroIntegrationTransportTable($schema);

        /** Foreign keys generation **/
        $this->addOroIntegrationTransportForeignKeys($schema);
    }

    /**
     * Create oro_integration_transport table
     *
     * @param Schema $schema
     */
    protected function createOroIntegrationTransportTable(Schema $schema)
    {
        $table = $schema->createTable('oro_integration_transport');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('ups_country_code', 'string', ['notnull' => false, 'length' => 2]);
        $table->addColumn('type', 'string', ['length' => 30]);
        $table->addColumn('money_order_pay_to', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('money_order_send_to', 'text', ['notnull' => false]);
        $table->addColumn('pp_express_checkout_action', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('pp_credit_card_action', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('pp_allowed_card_types', 'array', ['notnull' => false, 'comment' => '(DC2Type:array)']);
        $table->addColumn('pp_express_checkout_name', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('pp_partner', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_vendor', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_user', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_password', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_test_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_debug_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_require_cvv_entry', 'boolean', ['default' => '1', 'notnull' => false]);
        $table->addColumn('pp_zero_amount_authorization', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_auth_for_req_amount', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_use_proxy', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_proxy_host', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_proxy_port', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_enable_ssl_verification', 'boolean', ['default' => '1', 'notnull' => false]);
        $table->addColumn('orocrm_zd_email', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('orocrm_zd_url', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_zd_token', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_zd_default_user_email', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('orocrm_dm_api_username', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_password', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_client_id', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_client_key', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_custom_domain', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ldap_host', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ldap_port', 'integer', ['notnull' => false]);
        $table->addColumn('ldap_encryption', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ldap_base_dn', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ldap_username', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ldap_password', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ldap_account_domain', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ldap_account_domain_short', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('fedex_test_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('fedex_ignore_package_dimension', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('fedex_key', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_password', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_account_number', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_meter_number', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_pickup_type', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_unit_of_weight', 'string', ['notnull' => false, 'length' => 3]);
        $table->addColumn('fedex_invalidate_cache_at', 'datetime', ['notnull' => false]);
        $table->addColumn('ups_test_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('ups_api_user', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_api_password', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_api_key', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_shipping_account_number', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('ups_shipping_account_name', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_pickup_type', 'string', ['notnull' => false, 'length' => 2]);
        $table->addColumn('ups_unit_of_weight', 'string', ['notnull' => false, 'length' => 3]);
        $table->addColumn('ups_invalidate_cache_at', 'datetime', ['notnull' => false]);
        $table->addIndex(['ups_country_code'], 'idx_d7a389a87cdff63f', []);
        $table->addIndex(['type'], 'oro_int_trans_type_idx', []);
        $table->setPrimaryKey(['id']);
    }

    /**
     * Add oro_integration_transport foreign keys.
     *
     * @param Schema $schema
     */
    protected function addOroIntegrationTransportForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('oro_integration_transport');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_dictionary_country'),
            ['ups_country_code'],
            ['iso2_code'],
            ['onUpdate' => null, 'onDelete' => null]
        );
    }
}
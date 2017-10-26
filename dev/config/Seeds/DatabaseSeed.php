<?php
use Migrations\AbstractSeed;

class DatabaseSeed extends AbstractSeed
{
    public function run()
    {
        $this->call('BanksSeed');
        $this->call('CarBrandsSeed');
        $this->call('CarModelsSeed');
        $this->call('CitiesSeed');
        $this->call('CommunesSeed');
        $this->call('PaymentMethodsSeed');
        $this->call('PermissionsSeed');
        $this->call('ReplacementsSeed');
        $this->call('RequestsTypesSeed');
        $this->call('RolesSeed');
        $this->call('SuppliesSeed');
        $this->call('UsersSeed');
        $this->call('CarsSeed');
        $this->call('AvailableServicesSeed');
        $this->call('AvailableServicesReplacementsSeed');
        $this->call('AvailableServicesSuppliesSeed');
        $this->call('CodesSeed');
        $this->call('BanksCodesSeed');
        $this->call('ProvidersSeed');
        $this->call('CarBrandsProvidersSeed');
        $this->call('PaymentRefundsSeed');
        $this->call('ProvidersPaymentRefundsSeed');
        $this->call('ReplacementsProvidersSeed');
        $this->call('RolesPermissionsSeed');
        $this->call('SuppliesProvidersSeed');
        $this->call('UsersPaymentRefundsSeed');
        $this->call('HelpsSeed');
    }
}

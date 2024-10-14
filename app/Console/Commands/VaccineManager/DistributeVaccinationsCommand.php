<?php

namespace App\Console\Commands\VaccineManager;

use Illuminate\Console\Command;
use App\Enums\VaccineRegistrationStatus;
use App\Actions\VaccineManager\DistributeVaccineRegistrationsAction;

class DistributeVaccinationsCommand extends Command
{
    protected $signature = 'vaccination:distribute';
    protected $description = 'Distribute vaccine registrations based on the first come, first serve strategy';

    public function __construct(protected DistributeVaccineRegistrationsAction $distributeAction)
    {
        parent::__construct();
    }

    public function handle(): void
    {

        $this->distributeAction->execute();

        $this->info('Vaccination distribution completed.');
    }
}

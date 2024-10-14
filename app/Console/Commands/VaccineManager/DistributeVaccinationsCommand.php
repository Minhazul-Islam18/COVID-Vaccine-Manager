<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\VaccineManager\DistributeVaccineRegistrationsAction;

class DistributeVaccinationsCommand extends Command
{
    protected $signature = 'vaccination:distribute';
    protected $description = 'Distribute vaccine registrations based on the first come, first serve strategy';

    protected DistributeVaccineRegistrationsAction $distributeAction;

    public function __construct(DistributeVaccineRegistrationsAction $distributeAction)
    {
        parent::__construct();
        $this->distributeAction = $distributeAction;
    }

    public function handle(): void
    {
        // Execute the action to distribute registrations
        $this->distributeAction->execute();

        $this->info('Vaccination distribution completed.');
    }
}

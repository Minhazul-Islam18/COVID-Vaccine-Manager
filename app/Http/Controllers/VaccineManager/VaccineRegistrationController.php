<?php

namespace App\Http\Controllers\VaccineManager;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\VaccineCenter;
use App\Http\Controllers\Controller;
use App\Actions\VaccineManager\RegisterVaccineAction;
use App\Http\Requests\VaccineManager\VaccineRegistrationRequest;

class VaccineRegistrationController extends Controller
{
    protected $registerVaccineAction;

    public function __construct(RegisterVaccineAction $registerVaccineAction)
    {
        $this->registerVaccineAction = $registerVaccineAction;
    }

    public function create(): Response
    {
        $centers = VaccineCenter::select(['id', 'name'])->get();
        return Inertia::render('Auth/Register', ['notify' => session('notify'), 'centers' => $centers]);
    }

    public function store(VaccineRegistrationRequest $request)
    {
        $this->registerVaccineAction->execute($request);

        return redirect()->route('vaccine-manager.frontend.vaccine-data')->with('flash', ['type' => 'success', 'title' => 'Registration successfull', 'message' => 'Your vaccination schedule will sent by mail before the Date.']);
    }
}

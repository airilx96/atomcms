<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffApplicationFormRequest;
use App\Models\WebsiteOpenPosition;
use App\Services\Community\StaffApplicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StaffApplicationsController extends Controller
{
    public function __construct(private readonly StaffApplicationService $staffApplicationService)
    {
    }

    public function index()
    {
        return view('community.staff-applications', [
            'positions' => $this->staffApplicationService->fetchOpenPositions(),
        ]);
    }

    public function show(WebsiteOpenPosition $position)
    {
        return view('community.staff-applications-apply', [
            'position' => $position->load('permission'),
        ]);
    }

    public function store(WebsiteOpenPosition $position, StaffApplicationFormRequest $request): RedirectResponse
    {
        if ($this->staffApplicationService->hasUserAppliedForPosition($request->user(), $position->permission->id)) {
            return redirect()->back()->withErrors([
                'message' => __('You have already applied for this position.'),
            ]);
        }

        if (!$this->staffApplicationService->isPositionOpenForApplication($position)) {
            return redirect()->back()->withErrors([
                'message' => __('You cannot apply for this position.'),
            ]);
        }

        $request->user()->applications()->create([
            'rank_id' => $position->permission->id,
            'content' => $request->input('content'),
        ]);

        return to_route('staff-applications.index')->with('success', __('Your application has been submitted!'));
    }
}

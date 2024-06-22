<?php

namespace App\Http\Controllers;

use App\Models\ProjectApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectApplicant $projectApplicant)
    {
        //
        if($projectApplicant->project->client_id != auth()->id()){
            abort(403, 'Kamu tidak punya izin untuk melihat halaman ini');
        }

        return view('admin.projects.applicant_details', compact('projectApplicant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectApplicant $projectApplicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectApplicant $projectApplicant)
    {
        //
        DB::transaction(function() use ($projectApplicant){
            $projectApplicant->update([
                'status' => 'Diterima',
            ]);

            ProjectApplicant::where('project_id', $projectApplicant->project_id)
            ->where('id', '!=', $projectApplicant->id)
            ->where('status', '=', 'Menunggu')
            ->update([
                'status' => 'Ditolak'
            ]);

            $projectApplicant->project->update([
                'has_started' => true,
            ]);

            return redirect()->route('admin.projects.show', [$projectApplicant->project, $projectApplicant->id]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectApplicant $projectApplicant)
    {
        //
    }
}

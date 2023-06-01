<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\ElectionDetail;
use App\Models\ElectionDay;
use App\Interfaces\AdminInterface;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class AdminController extends Controller
{
    // Existing methods and code

    public function __construct(AdminInterface $adminInterface)
    {
        $this->adminInterface = $adminInterface;
    }

    public function addCandidate(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->adminInterface->addCandidate($request);

            // Redirect back to the admin dashboard with a success message
            return redirect()->route('adminDashboard')->with('success', 'Candidate added successfully.');
        }catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            return redirect()->route('adminDashboard');
        }

    }

    public function addElectionDetails(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->adminInterface->addElectionDetails($request);
            // Redirect back to the admin dashboard with a success message
            return redirect()->route('adminDashboard');
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            return redirect()->route('adminDashboard');
        }
    }

    public function addElectionDay(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->adminInterface->addElectionDay($request);

            // Redirect back to the admin dashboard with a success message
            return redirect()->route('adminDashboard');
        }catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            return redirect()->route('adminDashboard');}

    }

    public function dashboard()
    {
        // Add your dashboard logic here

        return view('admin.dashboard');
    }

    public function addCandidateForm()
    {
        $candidates = $this->adminInterface->allCandidates();
        if($candidates!=null ) {
            return view('admin.add-candidate',['candidates' => $candidates]);
        }
    }

    public function addElectionDetailsForm()
    {
        // Return the add election details form view
        // Return the add candidate form view
        $electionDay = $this->adminInterface->allElectionDays();

        if ($electionDay != null) {
//         Fetch the candidates associated with the election day
            $candidate_id_info = $this->adminInterface->allCandidates();
            $electionDetails = $this->adminInterface->allElectionDetails();

            return view('admin.add-election-details',[
                'candidateIds' => $candidate_id_info,
                'electionDay'       => $electionDay,
                'electionDetails'   => $electionDetails,
                ]);
        }
    }



    public function addElectionDayForm()
    {
        $electionDays = $this->adminInterface->allElectionDays();

        return view('admin.add-election-day',['electionDays' => $electionDays]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\ElectionDetail;
use App\Models\ElectionDay;
use App\Interfaces\AdminInterface;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Existing methods and code

    public function __construct(AdminInterface $adminInterface)
    {
        $this->adminInterface = $adminInterface;
    }

    public function addCandidate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->adminInterface->addCandidate($request);
        // Redirect back to the admin dashboard with a success message
        return redirect()->route('adminDashboard')->with('success', 'Candidate added successfully.');
    }

    public function addElectionDetails(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the input fields
        $this->adminInterface->addElectionDetails($request);
//        $validatedData = $request->validate([
//            'candidate_id'    => 'required',
//            'election_day_id' => 'required',
//        ]);
//
//        // Create a new election detail instance
//        $election_detail = new ElectionDetail();
//        $election_detail->candidate_id = $validatedData['candidate_id'];
//        $election_detail->election_day_id = $validatedData['election_day_id'];
//
//        // Save the election detail to the database
//        $election_detail->save();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('adminDashboard')->with('success', 'Election details added successfully.');
    }

    public function addElectionDay(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->adminInterface->addElectionDay($request);

        // Validate the input fields
//        $validatedData = $request->validate([
//            'election_start_time' => 'required',
//            'election_end_time'   => 'required',
//            'election_date'       => 'required',
//        ]);
//
//        // Create a new election day instance
//        $election_day = new ElectionDay();
//
//        $election_day->election_start_time = $validatedData['election_start_time'];
//        $election_day->election_end_time = $validatedData['election_end_time'];
//        $election_day->election_date = $validatedData['election_date'];
//        // Save the election day to the database
//        $election_day->save();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('adminDashboard')->with('success', 'Election day added successfully.');
    }

    public function dashboard()
    {
        // Add your dashboard logic here

        // Return the admin dashboard view
        return view('admin.dashboard');
    }

    public function addCandidateForm()
    {
        // Return the add candidate form view
      //  $this->adminInterface->allCandidates();
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


            return view('admin.add-election-details',[
                'candidateIds' => $candidate_id_info,
                'electionDay'       => $electionDay,
                ]);
        }
    }



    public function addElectionDayForm()
    {
        $electionDays = $this->adminInterface->allElectionDays();

        return view('admin.add-election-day',['electionDays' => $electionDays]);
    }
}

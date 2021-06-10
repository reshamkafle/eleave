<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ManageLeaveApplicationDocumentContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {        
        $this->authorize('manage', LeaveApplication::class);

        $applicationDocuments = DB::table('leave_application_documents')
                                ->join('leave_applications', 'leave_applications.id', '=', 'leave_application_documents.leave_application_id')
                                ->where('leave_applications.id', '=', $id)
                                ->select(['leave_application_documents.name', 'leave_application_documents.id'])
                                ->get();

        return view('manage-leave-application-document.index', [
            'applicationDocuments' => $applicationDocuments,
    
        ]);
    }
}

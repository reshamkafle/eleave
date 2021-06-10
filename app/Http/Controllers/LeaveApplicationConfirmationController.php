<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeaveApplicationDocument;


class LeaveApplicationConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        session(['pageTitle' => 'Leave Application Document']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $application = DB::table('leave_applications')
                        ->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
                        ->where('leave_applications.id', '=', $id)
                        ->select(['leave_applications.id','leave_types.name as leaveType', 'leave_applications.created_at', 'startDate', 'endDate','noOfDayApplied', 'noOfWorkingDay', 'noOfPublicHoliday', 'fullDay', 'noOfDayDeduct', 'leave_applications.needCertificate'])
                        ->first();

        $applicationDocuments = DB::table('leave_application_documents')
                        ->where('leave_application_id', '=', $id)
                        ->select(['file', 'name', 'id'])
                        ->get();


        return view('leave-application-confirmation.confirmation', [
        'application' => $application,
        'applicationDocuments'=>$applicationDocuments
        ]);

    }

    public function destroy($id)
    {
        $document = LeaveApplicationDocument::find($id);
        $document->delete();

        return redirect()->route('leave_application_confirmation', $id)->with('success', trans('message.delete_success'));

    }

    public function download($id)
    {
        $application = DB::table('leave_application_documents')
                        ->where('id', '=', $id)
                        ->select(['file', 'name', 'mime'])
                        ->first();

        $file_contents = base64_decode($application->file);

        return response($file_contents)
                         ->header('Cache-Control', 'no-cache private')
                         ->header('Content-Description', 'File Transfer')
                         ->header('Content-Type', $application->mime)
                         ->header('Content-length', strlen($file_contents))
                         ->header('Content-Disposition', 'attachment; filename=' . $application->name)
                         ->header('Content-Transfer-Encoding', 'binary');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'mimes:jpeg,bmp,png,pdf,jpg',
            'name' => 'required|max:255',
        ]);

        if ($request->hasFile('file')) {
            
            $path = $request->file('file')->getRealPath();
            $ext = $request->file->extension();
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);
            $mime = $request->file('file')->getClientMimeType();

            LeaveApplicationDocument::create([
                'name'=> $request->name .'.'.$ext,
                'file' => $base64,
                'leave_application_id' => $id,
                'mime'=> $mime,
            ]);

            return redirect()->route('leave_application_confirmation', $id)->with('success', trans('message.update_success'));

        }
        
    }
}

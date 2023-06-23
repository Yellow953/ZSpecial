<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use App\Models\DollarRate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('backup.index');
    }

    public function ExportUsers()
    {
        $data = User::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Role');
        $sheet->setCellValue('E1', 'Phone Number');
        $rows = 2;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $rows, $d->id);
            $sheet->setCellValue('B' . $rows, $d->name);
            $sheet->setCellValue('C' . $rows, $d->email);
            $sheet->setCellValue('D' . $rows, $d->role);
            $sheet->setCellValue('E' . $rows, $d->phone_number);
            $rows++;
        }

        $fileName = "Users.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/xls");
        header("Content-Disposition: attachement; filename: " . $fileName);
        return response()->file($fileName);
    }

    public function ExportLogs()
    {
        $data = Log::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Text');
        $rows = 2;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $rows, $d->id);
            $sheet->setCellValue('B' . $rows, $d->text);
            $rows++;
        }

        $fileName = "Logs.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/xls");
        header("Content-Disposition: attachement; filename: " . $fileName);
        return response()->file($fileName);
    }

    public function ImportUsers(Request $request)
    {
        $this->validate($request, [
            'users' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('users');

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);
        $column_range = range('E', $column_limit);

        User::truncate();

        foreach ($row_range as $row) {
            $user = new User();
            $user->id = $sheet->getCell('A' . $row)->getValue();
            $user->name = $sheet->getCell('B' . $row)->getValue();
            $user->email = $sheet->getCell('C' . $row)->getValue();
            $user->role = $sheet->getCell('D' . $row)->getValue();
            $user->phone = $sheet->getCell('E' . $row)->getValue();
            $user->image = "/assets/images/profiles/default_profile.png";
            $user->password = Hash::make('qwe123');
            $user->created_at = Carbon::now();
            $user->save();
        }

        $log = new Log();
        $log->text = Auth()->user()->name . " imported all users in " . Carbon::now()->toDateTimeString();
        $log->save();
        return redirect()->back()->with('success', 'Users imported successfully!');
    }

    public function ImportLogs(Request $request)
    {
        $this->validate($request, [
            'logs' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('logs');

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);
        $column_range = range('B', $column_limit);

        Log::truncate();

        foreach ($row_range as $row) {
            $log = new Log();
            $log->id = $sheet->getCell('A' . $row)->getValue();
            $log->text = $sheet->getCell('B' . $row)->getValue();
            $log->created_at = Carbon::now();
            $log->save();
        }

        $log = new Log();
        $log->text = Auth()->user()->name . " imported all logs in " . Carbon::now()->toDateTimeString();
        $log->save();
        return redirect()->back()->with('success', 'Logs imported successfully!');
    }
}
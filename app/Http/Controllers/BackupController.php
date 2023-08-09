<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
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
        $sheet->setCellValue('F1', 'Created At');
        $rows = 2;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $rows, $d->id);
            $sheet->setCellValue('B' . $rows, $d->name);
            $sheet->setCellValue('C' . $rows, $d->email);
            $sheet->setCellValue('E' . $rows, $d->phone ?? '');
            $sheet->setCellValue('D' . $rows, $d->role);
            $sheet->setCellValue('F' . $rows, $d->created_at);
            $rows++;
        }

        $fileName = "Users.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/xls");
        header("Content-Disposition: attachement; filename: " . $fileName);
        return response()->file($fileName);
    }

    public function ExportCategories()
    {
        $data = Category::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Description');
        $sheet->setCellValue('D1', 'Created At');
        $rows = 2;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $rows, $d->id);
            $sheet->setCellValue('B' . $rows, $d->name);
            $sheet->setCellValue('C' . $rows, $d->description ?? '');
            $sheet->setCellValue('D' . $rows, $d->created_at);
            $rows++;
        }

        $fileName = "Categories.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/xls");
        header("Content-Disposition: attachement; filename: " . $fileName);
        return response()->file($fileName);
    }

    public function ExportProducts()
    {
        $data = Product::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Quantity');
        $sheet->setCellValue('D1', 'Buy Price');
        $sheet->setCellValue('E1', 'Sell Price');
        $sheet->setCellValue('F1', 'Category ID');
        $sheet->setCellValue('G1', 'Description');
        $sheet->setCellValue('H1', 'Created At');
        $rows = 2;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $rows, $d->id);
            $sheet->setCellValue('B' . $rows, $d->name);
            $sheet->setCellValue('C' . $rows, $d->quantity);
            $sheet->setCellValue('D' . $rows, $d->buy_price);
            $sheet->setCellValue('E' . $rows, $d->sell_price);
            $sheet->setCellValue('F' . $rows, $d->category_id);
            $sheet->setCellValue('G' . $rows, $d->description ?? '');
            $sheet->setCellValue('H' . $rows, $d->created_at);
            $rows++;
        }

        $fileName = "Products.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/xls");
        header("Content-Disposition: attachement; filename: " . $fileName);
        return response()->file($fileName);
    }

    public function ExportOrders()
    {
        $data = Order::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'User ID');
        $sheet->setCellValue('C1', 'Total Price');
        $sheet->setCellValue('D1', 'Created At');
        $rows = 2;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $rows, $d->id);
            $sheet->setCellValue('B' . $rows, $d->user_id);
            $sheet->setCellValue('C' . $rows, $d->total_price);
            $sheet->setCellValue('D' . $rows, $d->created_at);
            $rows++;
        }

        $fileName = "Orders.xls";
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

        $sheet->setCellValue('A1', 'Text');
        $sheet->setCellValue('B1', 'Created At');

        $rows = 2;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $rows, $d->text);
            $sheet->setCellValue('B' . $rows, $d->created_at);
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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();

        foreach ($row_range as $row) {
            $user = new User();
            $user->id = $sheet->getCell('A' . $row)->getValue();
            $user->name = $sheet->getCell('B' . $row)->getValue();
            $user->email = $sheet->getCell('C' . $row)->getValue();
            $user->phone = $sheet->getCell('E' . $row)->getValue() ?? '';
            $user->role = $sheet->getCell('D' . $row)->getValue();
            $user->created_at = Carbon::parse($sheet->getCell('F' . $row)->getValue()) ?? Carbon::now();
            $user->password = Hash::make('qwe123');
            $user->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $log = new Log();
        $log->text = Auth()->user()->name . " imported all users, datetime: " . now();
        $log->save();
        return redirect()->back()->with('success', 'Users imported successfully!');
    }

    public function ImportCategories(Request $request)
    {
        $this->validate($request, [
            'categories' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('categories');

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();

        foreach ($row_range as $row) {
            $category = new Category();
            $category->id = $sheet->getCell('A' . $row)->getValue();
            $category->name = $sheet->getCell('B' . $row)->getValue();
            $category->description = $sheet->getCell('C' . $row)->getValue() ?? '';
            $category->created_at = Carbon::parse($sheet->getCell('D' . $row)->getValue()) ?? Carbon::now();
            $category->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $log = new Log();
        $log->text = Auth()->user()->name . " imported all categories, datetime: " . now();
        $log->save();
        return redirect()->back()->with('success', 'Categories imported successfully!');
    }

    public function ImportProducts(Request $request)
    {
        $this->validate($request, [
            'products' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('products');

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();

        foreach ($row_range as $row) {
            $product = new Product();
            $product->id = $sheet->getCell('A' . $row)->getValue();
            $product->name = $sheet->getCell('B' . $row)->getValue();
            $product->quantity = $sheet->getCell('C' . $row)->getValue();
            $product->buy_price = $sheet->getCell('D' . $row)->getValue();
            $product->sell_price = $sheet->getCell('E' . $row)->getValue();
            $product->category_id = $sheet->getCell('F' . $row)->getValue();
            $product->description = $sheet->getCell('G' . $row)->getValue() ?? '';
            $product->created_at = Carbon::parse($sheet->getCell('H' . $row)->getValue()) ??
                $product->image = 'assets/images/no_img.png';
            Carbon::now();
            $product->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $log = new Log();
        $log->text = Auth()->user()->name . " imported all products, datetime: " . now();
        $log->save();
        return redirect()->back()->with('success', 'Products imported successfully!');
    }

    public function ImportOrders(Request $request)
    {
        $this->validate($request, [
            'orders' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('orders');

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();

        foreach ($row_range as $row) {
            $order = new Order();
            $order->id = $sheet->getCell('A' . $row)->getValue();
            $order->user_id = $sheet->getCell('B' . $row)->getValue();
            $order->total_price = $sheet->getCell('C' . $row)->getValue();
            $order->created_at = Carbon::parse($sheet->getCell('D' . $row)->getValue()) ?? Carbon::now();
            $order->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $log = new Log();
        $log->text = Auth()->user()->name . " imported all orders, datetime: " . now();
        $log->save();
        return redirect()->back()->with('success', 'Orders imported successfully!');
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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Log::truncate();

        foreach ($row_range as $row) {
            $log = new Log();
            $log->text = $sheet->getCell('A' . $row)->getValue();
            $log->created_at = Carbon::parse($sheet->getCell('B' . $row)->getValue()) ?? Carbon::now();
            $log->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $log = new Log();
        $log->text = Auth()->user()->name . " imported all logs in " . Carbon::now();
        $log->save();
        return redirect()->back()->with('success', 'Logs imported successfully!');
    }
}
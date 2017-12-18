<?php

namespace App\Http\Controllers\Admin;

use App\Export;
use App\Import;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * "Главная" админки
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function exportToCsv()
    {
        $export = new Export();
        $downloadLink = $export->run();
        return redirect($downloadLink);
    }

    /**
     * Страница с формой импорта
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function importForm()
    {
        return view('admin.import.form');
    }

    public function importFromCsv(Request $request)
    {
        $import = new Import($request->file);
        $import->run();
        dd('Импорт прошел');
    }
}

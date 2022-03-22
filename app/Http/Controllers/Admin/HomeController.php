<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedagang;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Tempat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $pedagang = Pedagang::query()->count();
        $tempat   = Tempat::query()->count();
        $admin    = User::query()->count();

        $pengeluarans = Pengeluaran::query()->addSelect(["month_name" => DB::raw('MONTHNAME(tgl) AS month_name'), "nominal"])->whereYear('tgl', date('Y'))->get()->toArray();
        $pemasukans   = Pemasukan::query()->addSelect(["month_name" => DB::raw('MONTHNAME(tgl) AS month_name'), "nominal"])->whereYear('tgl', date('Y'))->get()->toArray();

        $months   = ['January', 'February', 'March', 'April', 'Mei', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $spending = [];
        $income   = [];

        foreach ($months as $month) {

            if (count($pengeluarans) > 0) {
                foreach ($pengeluarans as $pengeluaran) {
                    if ($pengeluaran['month_name'] === $month) {
                        if (array_key_exists($month, $spending)) {
                            $spending[$month] += $pengeluaran['nominal'];
                        } else {
                            $spending[$month] = $pengeluaran['nominal'];
                        }
                    } elseif (!in_array($month, array_keys($spending))) {
                        $spending[$month] = 0;
                    }
                }
            } else {
                $spending[$month] = 0;
            }

            if (count($pemasukans) > 0) {
                foreach ($pemasukans as $pemasukan) {
                    if ($pemasukan['month_name'] === $month) {
                        if (array_key_exists($month, $income)) {
                            $income[$month] += $pemasukan['nominal'];
                        } else {
                            $income[$month] = $pemasukan['nominal'];
                        }
                    } elseif (!in_array($month, array_keys($income))) {
                        $income[$month] = 0;
                    }
                }
            } else {
                $income[$month] = 0;
            }
        }

        return view('admin.pages.home.index', compact('pedagang', 'tempat', 'admin', 'income', 'spending'));
    }
}

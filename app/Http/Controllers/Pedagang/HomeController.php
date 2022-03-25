<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::query()->where('pedagang_id', auth('pedagang')->id())->sum('nominal');
        $tagihan    = Tagihan::query()->where('pedagang_id', auth('pedagang')->id())->sum('nominal');

        $pengeluarans = Pembayaran::query()->addSelect(["month_name" => DB::raw('MONTHNAME(tgl) AS month_name'), "nominal"])->where('pedagang_id', auth('pedagang')->id())->get()->toArray();

        $months   = ['January', 'February', 'March', 'April', 'Mei', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $spending = [];

        foreach ($months as $month) {

            // if pengeluaran has elements more than 0
            if (count($pengeluarans) > 0) {
                foreach ($pengeluarans as $pengeluaran) {

                    // check if pengeluaran month same with $month
                    if ($pengeluaran['month_name'] === $month) {

                        // if $spending has $month, increment with nominal
                        // else create new $spending with key $month
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
        }

        return view('pedagang.pages.home.index', compact('pembayaran', 'tagihan', 'spending'));
    }
}

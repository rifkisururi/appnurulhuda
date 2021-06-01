<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class laporanController extends Controller
{
    public function perTahun()
    {
        $data = DB::select("
	select 
		u.id, u.name, 
		sum(tg1.jumlah) as tagihan1, sum(tg1b.jumlah) as pembayaran1,
		sum(tg2.jumlah) as tagihan2, sum(tg2b.jumlah) as pembayaran2,
		sum(tg3.jumlah) as tagihan3, sum(tg3b.jumlah) as pembayaran3,
		sum(tg4.jumlah) as tagihan4, sum(tg4b.jumlah) as pembayaran4,
		sum(tg5.jumlah) as tagihan5, sum(tg5b.jumlah) as pembayaran5,
		sum(tg6.jumlah) as tagihan6, sum(tg6b.jumlah) as pembayaran6,
		sum(tg7.jumlah) as tagihan7, sum(tg7b.jumlah) as pembayaran7,
		sum(tg8.jumlah) as tagihan8, sum(tg8b.jumlah) as pembayaran8,
		sum(tg9.jumlah) as tagihan9, sum(tg9b.jumlah) as pembayaran9,
		sum(tg10.jumlah) as tagihan10, sum(tg10b.jumlah) as pembayaran10,
		sum(tg11.jumlah) as tagihan11, sum(tg11b.jumlah) as pembayaran11,
		sum(tg12.jumlah) as tagihan12, sum(tg12b.jumlah) as pembayaran12
    from 
        users u
        left join tagihan_detail tg1 on u.id = tg1.id_user and month(tg1.jatuh_tempo) = 1
        left join tagihan_detail tg1b on u.id = tg1b.id_user and month(tg1b.jatuh_tempo) = 1 and tg1b.flag_pay = 1
        
        left join tagihan_detail tg2 on u.id = tg2.id_user and month(tg2.jatuh_tempo) = 2
        left join tagihan_detail tg2b on u.id = tg2b.id_user and month(tg2b.jatuh_tempo) = 2 and tg2b.flag_pay = 1
        
        left join tagihan_detail tg3 on u.id = tg3.id_user and month(tg3.jatuh_tempo) = 3
        left join tagihan_detail tg3b on u.id = tg3b.id_user and month(tg3b.jatuh_tempo) = 3 and tg3b.flag_pay = 1
        
        left join tagihan_detail tg4 on u.id = tg4.id_user and month(tg4.jatuh_tempo) = 4
        left join tagihan_detail tg4b on u.id = tg4b.id_user and month(tg4b.jatuh_tempo) = 4 and tg4b.flag_pay = 1
        
        left join tagihan_detail tg5 on u.id = tg5.id_user and month(tg5.jatuh_tempo) = 5
        left join tagihan_detail tg5b on u.id = tg5b.id_user and month(tg5b.jatuh_tempo) = 5 and tg5b.flag_pay = 1
        
        left join tagihan_detail tg6 on u.id = tg6.id_user and month(tg6.jatuh_tempo) = 6
        left join tagihan_detail tg6b on u.id = tg6b.id_user and month(tg6b.jatuh_tempo) = 6 and tg6b.flag_pay = 1
        
        left join tagihan_detail tg7 on u.id = tg7.id_user and month(tg7.jatuh_tempo) = 7
        left join tagihan_detail tg7b on u.id = tg7b.id_user and month(tg7b.jatuh_tempo) = 7 and tg7b.flag_pay = 1
        
        left join tagihan_detail tg8 on u.id = tg8.id_user and month(tg8.jatuh_tempo) = 8
        left join tagihan_detail tg8b on u.id = tg8b.id_user and month(tg8b.jatuh_tempo) = 8 and tg8b.flag_pay = 1
        
        left join tagihan_detail tg9 on u.id = tg9.id_user and month(tg9.jatuh_tempo) = 9
        left join tagihan_detail tg9b on u.id = tg9b.id_user and month(tg9b.jatuh_tempo) =9 and tg9b.flag_pay = 1
        
        left join tagihan_detail tg10 on u.id = tg10.id_user and month(tg10.jatuh_tempo) = 10
        left join tagihan_detail tg10b on u.id = tg10b.id_user and month(tg10b.jatuh_tempo) = 10 and tg10b.flag_pay = 1
        
        left join tagihan_detail tg11 on u.id = tg11.id_user and month(tg11.jatuh_tempo) = 11
        left join tagihan_detail tg11b on u.id = tg11b.id_user and month(tg11b.jatuh_tempo) = 11 and tg11b.flag_pay = 1
        
        left join tagihan_detail tg12 on u.id = tg12.id_user and month(tg12.jatuh_tempo) = 12
        left join tagihan_detail tg12b on u.id = tg12b.id_user and month(tg12b.jatuh_tempo) = 12 and tg12b.flag_pay = 1
    GROUP BY 
        u.id, u.name
        ");

        return view('admin.laporan.tahunan', [
            'data' => $data
        ]);
    }

    public function rekapTunggakan()
    {
        $data = DB::select("
        select 
            id, 
            namaSantri as name, 
            REPLACE(concat(
                '<table><th>Jumlah Tagihan</th><th>Nama Tagihan</th><th>Biaya</th><th>Sub Total</th>',
                group_concat('<tr><td>',jumlahPerJenis, 'X </td><td>', namaTagihan, '</td><td>', FORMAT(jumlah,0), ' </td><td> ' , FORMAT(totalPerTagihan ,0), '</td></tr>'),
                '</table>'),'</tr>,<tr>','</tr><tr>') as tunggakan,
            sum(total) as total
        from
        (
            select 
                u.id, u.name as namaSantri, 
                COUNT(tm.id) as jumlahPerJenis,
                tm.name as namaTagihan,
                td.jumlah, 
                sum(td.jumlah) as totalPerTagihan,
                sum(td.jumlah) as total
            from 
                users u
                left join tagihan_detail td on u.id = td.id_user
                left join tagihan_master tm on td.id_tagihan_master = tm.id 
            where 
                td.flag_pay = 0
            GROUP by u.id, u.name, tm.id, tm.name, td.jumlah
        ) a
        GROUP by id, namaSantri
        ");

        return view('admin.laporan.tunggakan', [
            'data' => $data
        ]);
    }
}

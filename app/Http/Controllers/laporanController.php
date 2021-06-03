<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class laporanController extends Controller
{
    public function perTahun()
    {
        $data = DB::select("
	select * from (
        select 
            u.id, u.name, y.id as id_yayasan, y.nama as nama_yayasan,
            IFNULL(sum(tg1.jumlah),0)  as tagihan1, IFNULL(sum(tg1b.jumlah),0) as pembayaran1,
            IFNULL(sum(tg2.jumlah),0)  as tagihan2, IFNULL(sum(tg2b.jumlah),0) as pembayaran2,
            IFNULL(sum(tg3.jumlah),0)  as tagihan3, IFNULL(sum(tg3b.jumlah),0) as pembayaran3,
            IFNULL(sum(tg4.jumlah),0)  as tagihan4, IFNULL(sum(tg4b.jumlah),0) as pembayaran4,
            IFNULL(sum(tg5.jumlah),0)  as tagihan5, IFNULL(sum(tg5b.jumlah),0) as pembayaran5,
            IFNULL(sum(tg6.jumlah),0)  as tagihan6, IFNULL(sum(tg6b.jumlah),0) as pembayaran6,
            IFNULL(sum(tg7.jumlah),0)  as tagihan7, IFNULL(sum(tg7b.jumlah),0) as pembayaran7,
            IFNULL(sum(tg8.jumlah),0)  as tagihan8, IFNULL(sum(tg8b.jumlah),0) as pembayaran8,
            IFNULL(sum(tg9.jumlah),0)  as tagihan9, IFNULL(sum(tg9b.jumlah),0) as pembayaran9,
            IFNULL(sum(tg10.jumlah),0)  as tagihan10, IFNULL(sum(tg10b.jumlah),0) as pembayaran10,
            IFNULL(sum(tg11.jumlah),0)  as tagihan11, IFNULL(sum(tg11b.jumlah),0) as pembayaran11,
            IFNULL(sum(tg12.jumlah),0) as tagihan12, IFNULL(sum(tg12b.jumlah),0) as pembayaran12
        from 
            users u
            left join yayasan y on u.id_yayasan = y.id
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
            u.id, u.name, y.id , y.nama , u.id_yayasan
        ) a 
    where 
        a.tagihan1 - a.pembayaran1 != 0 or
        a.tagihan2 - a.pembayaran2 != 0 or
        a.tagihan3 - a.pembayaran3 != 0 or
        a.tagihan4 - a.pembayaran4 != 0 or
        a.tagihan5 - a.pembayaran5 != 0 or
        a.tagihan6 - a.pembayaran6 != 0 or
        a.tagihan7 - a.pembayaran7 != 0 or
        a.tagihan8 - a.pembayaran8 != 0 or
        a.tagihan9 - a.pembayaran9 != 0 or
        a.tagihan10 - a.pembayaran10 != 0 or
        a.tagihan11 - a.pembayaran11 != 0 or
        a.tagihan12 - a.pembayaran12 != 0 
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

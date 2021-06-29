<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class laporanController extends Controller
{
    public function perTahun()
    {
        if (isset($_GET['tahun'])) {
            $tahun = $_GET['tahun'];
        } else {
            $tahun = date("Y");
        }

        if (isset($_GET['id_yayasan'])) {
            $id_yayasan = $_GET['id_yayasan'];
        } else {
            $id_yayasan = 0;
        }

        if ($id_yayasan != 0) {
            $fiterYayasan = " and y.id = $id_yayasan";
        } else {
            $fiterYayasan = "";
        }


        $data = DB::select("
        select * from (
            select 
				u.id,u.name,y.id as id_yayasan, 
				y.nama as nama_yayasan
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 1 and year(td.jatuh_tempo) = $tahun) as tagihan1
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 2 and year(td.jatuh_tempo) = $tahun) as tagihan2
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 3 and year(td.jatuh_tempo) = $tahun) as tagihan3
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 4 and year(td.jatuh_tempo) = $tahun) as tagihan4
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 5 and year(td.jatuh_tempo) = $tahun) as tagihan5
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 6 and year(td.jatuh_tempo) = $tahun) as tagihan6
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 7 and year(td.jatuh_tempo) = $tahun) as tagihan7
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 8 and year(td.jatuh_tempo) = $tahun) as tagihan8
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 9 and year(td.jatuh_tempo) = $tahun) as tagihan9
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 10 and year(td.jatuh_tempo) = $tahun) as tagihan10
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 11 and year(td.jatuh_tempo) = $tahun) as tagihan11
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 12 and year(td.jatuh_tempo) = $tahun) as tagihan12
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 1 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran1
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 2 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran2
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 3 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran3
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 4 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran4
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 5 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran5
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 6 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran6
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 7 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran7
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 8 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran8
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 9 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran9
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 10 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran10
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 11 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran11
				,(select IFNULL(sum(td.jumlah),0) from tagihan_detail td where td.id_user = u.id and month(td.jatuh_tempo) = 12 and year(td.jatuh_tempo) = $tahun and td.flag_pay = 1) as pembayaran12
			from 
				users u
				INNER JOIN yayasan y on y.id = u.id_yayasan
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
        $yayasan = DB::table('yayasan')->get();


        return view('admin.laporan.tahunan', [
            'data' => $data,
            'yayasan' => $yayasan
        ]);
    }

    public function rekapTunggakan()
    {
        $data = DB::select("
        select 
            id, 
            namaSantri as name, NamaYayasan ,
            REPLACE(concat(
                '<table><th>Jumlah Tagihan</th><th>Nama Tagihan</th><th>Biaya</th><th>Sub Total</th>',
                group_concat('<tr><td>',jumlahPerJenis, 'X </td><td>', namaTagihan, '</td><td>', FORMAT(jumlah,0), ' </td><td> ' , FORMAT(totalPerTagihan ,0), '</td></tr>'),
                '</table>'),'</tr>,<tr>','</tr><tr>') as tunggakan,
            sum(total) as total
        from
        (
            select 
                u.id, u.name as namaSantri, y.nama as NamaYayasan,
                COUNT(tm.id) as jumlahPerJenis,
                tm.name as namaTagihan,
                td.jumlah, 
                sum(td.jumlah) as totalPerTagihan,
                sum(td.jumlah) as total
            from 
                users u
                left join tagihan_detail td on u.id = td.id_user
                left join tagihan_master tm on td.id_tagihan_master = tm.id
                left join yayasan y on y.id = u.id_yayasan
            where 
                td.flag_pay = 0
            GROUP by u.id, u.name, tm.id, tm.name, td.jumlah, y.nama
        ) a
        GROUP by id, namaSantri, NamaYayasan
        ");

        return view('admin.laporan.tunggakan', [
            'data' => $data
        ]);
    }
}

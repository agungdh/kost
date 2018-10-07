<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PublicAjaxController extends Controller
{
    public function prop()
    {
    	$props_raw = DB::table('prop')->get();

    	?>
    	<option value="">Pilih Provinsi</option>
    	<?php
        foreach ($props_raw as $value) {
            ?>
            <option value="<?php echo $value->id; ?>"><?php echo ucwords(strtolower($value->nama_prop)); ?></option>
            <?php 
        }
    }

    public function kab(Request $request)
    {
    	$kabs_raw = DB::table('kab')->where('prop_id', $request->prop)->get();

    	?>
    	<option value="">Pilih Kabupaten</option>
    	<?php
        foreach ($kabs_raw as $value) {
            ?>
            <option value="<?php echo $value->id; ?>"><?php echo ucwords(strtolower($value->nama_kab)); ?></option>
            <?php 
        }
    }

    public function kec(Request $request)
    {
    	$kecs_raw = DB::table('kec')->where('kab_id', $request->kab)->get();

    	?>
    	<option value="">Pilih Kecamatan</option>
    	<?php
        foreach ($kecs_raw as $value) {
            ?>
            <option value="<?php echo $value->id; ?>"><?php echo ucwords(strtolower($value->nama_kec)); ?></option>
            <?php 
        }
    }

    public function desa(Request $request)
    {
    	$desas_raw = DB::table('desa')->where('kec_id', $request->kec)->get();

    	?>
    	<option value="">Pilih Kelurahan</option>
    	<?php
        foreach ($desas_raw as $value) {
            ?>
            <option value="<?php echo $value->id; ?>"><?php echo ucwords(strtolower($value->nama_desa)); ?></option>
            <?php 
        }
    }

    public function getDataDaerahByDesa(Request $request)
    {
        $data = DB::select('SELECT de.id desa_id, de.kec_id, de.nama_desa, ke.kab_id, ke.nama_kec, ka.prop_id, ka.nama_kab, p.nama_prop
                    FROM prop p, kab ka, kec ke, desa de
                    WHERE de.kec_id = ke.id
                    AND ke.kab_id = ka.id
                    AND ka.prop_id = p.id
                    AND de.id = ?', [$request->desa]);

        if ($data) {
            echo json_encode($data[0]);
        } else {
            echo json_encode(FALSE);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;

class PublicAjaxController extends Controller
{
    public function prop()
    {
    	$props_raw = Provinsi::all();

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
    	$kabs_raw = Kabupaten::where('prop_id', $request->prop)->get();

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
    	$kecs_raw = Kecamatan::where('kab_id', $request->kab)->get();

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
    	$desas_raw = Kelurahan::where('kec_id', $request->kec)->get();

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
        $data = DB::table('v_daerah')->where('desa_id', $request->desa)->first();

        echo json_encode($data);
    }
}

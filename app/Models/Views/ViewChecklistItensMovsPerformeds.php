<?php

namespace App\Models\Views;

use Illuminate\Support\Facades\DB;

class ViewChecklistItensMovsPerformeds extends ViewsDatabase{
    protected $fillable = [
        'chmv_id ',
        'chmv_description',
        'chmv_status ',
        'chmv_start_date ',
        'chmv_end_dat',
        'chmv_user_id',
        'chmv_chkl_id',
        'chmv_chcl_id',
        'chmv_unit_id',
        'chmv_created_at ',
        'chmv_updated_at ',
        'chmv_process',
        'chim_id ',
        'chim_description',
        'chim_sequenc',
        'chim_sco',
        'chim_status ',
        'chim_typ',
        'chim_process',
        'chim_respons',
        'chim_type_ob',
        'chim_required_photo ',
        'chim_quant_photo',
        'chim_user_id',
        'chim_chit_id',
        'chim_sect_id',
        'chim_updated_at ',
        'chim_photos ',
        'sect_description',
        'chit_description',
        'chit_run_sco',
    ];

    protected $casts = [
        'chmv_id' => 'integer',
        'chmv_start_date' => 'date',
        'chmv_end_date' => 'date',
        'chmv_user_id' => 'integer',
        'chmv_chkl_id' => 'integer',
        'chmv_chcl_id' => 'integer',
        'chmv_unit_id' => 'integer',
        'chmv_created_at' => 'date',
        'chmv_updated_at' => 'date',
        'chim_id' => 'integer',
        'chim_sequence' => 'integer',
        'chim_score' => 'integer',
        'chim_quant_photo' => 'integer',
        'chim_user_id' => 'integer',
        'chim_chit_id' => 'integer',
        'chim_sect_id' => 'integer',
        'chim_updated_at' => 'date',
        'chit_run_score' => 'float',
    ];

    public function chmv_id(){
        return $this->chmv_id;
    }

    public function chmv_description(){
        return $this->chmv_description;
    }

    public function chmv_status(){
        return $this->chmv_status;
    }

    public function chmv_start_date(){
        return $this->chmv_start_date;
    }

    public function chmv_end_date(){
        return $this->chmv_end_date;
    }

    public function chmv_user_id(){
        return $this->chmv_user_id;
    }

    public function chmv_chkl_id(){
        return $this->chmv_chkl_id;
    }

    public function chmv_chcl_id(){
        return $this->chmv_chcl_id;
    }

    public function chmv_unit_id(){
        return $this->chmv_unit_id;
    }

    public function chmv_created_at(){
        return $this->chmv_created_at;
    }

    public function chmv_updated_at(){
        return $this->chmv_updated_at;
    }

    public function chmv_processed(){
        return $this->chmv_processed;
    }

    public function chim_id(){
        return $this->chim_id;
    }

    public function chim_description(){
        return $this->chim_description;
    }

    public function chim_sequence(){
        return $this->chim_sequence;
    }

    public function chim_score(){
        return $this->chim_score;
    }

    public function chim_status(){
        return $this->chim_status;
    }

    public function chim_type(){
        return $this->chim_type;
    }

    public function chim_processed(){
        return $this->chim_processed;
    }

    public function chim_response(){
        return $this->chim_response;
    }

    public function chim_type_obs(){
        return $this->chim_type_obs;
    }

    public function chim_required_photo(){
        return $this->chim_required_photo;
    }

    public function chim_quant_photo(){
        return $this->chim_quant_photo;
    }

    public function chim_user_id(){
        return $this->chim_user_id;
    }

    public function chim_chit_id(){
        return $this->chim_chit_id;
    }

    public function chim_sect_id(){
        return $this->chim_sect_id;
    }

    public function chim_updated_at(){
        return $this->chim_updated_at;
    }

    public function chim_photos(){
        return $this->chim_photos;
    }

    public function sect_description(){
        return $this->sect_description;
    }

    public function chit_description(){
        return $this->chit_description;
    }

    public function chit_run_score(){
        return $this->chit_run_score;
    }

    public function get($sql){
        $data = DB::select($sql);

    }

}
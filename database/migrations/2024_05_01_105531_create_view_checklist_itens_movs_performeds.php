<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        $SQL = 'select'
            .'    chmv.id as "chmv_id" ,'
            .'    chmv.description as "chmv_description" ,'
            .'    chmv.status as "chmv_status" ,'
            .'    chmv.start_date as "chmv_start_date" ,'
            .'    chmv.end_date as "chmv_end_date" ,'
            .'    chmv.user_id as "chmv_user_id" ,'
            .'    chmv.chkl_id as "chmv_chkl_id" ,'
            .'    chmv.chcl_id as "chmv_chcl_id" ,'
            .'    chmv.unit_id as "chmv_unit_id" ,'
            .'    chmv.created_at as "chmv_created_at" ,'
            .'    chmv.updated_at as "chmv_updated_at" ,'
            .'    chmv.processed as "chmv_processed" ,'
            .'    chim.id as "chim_id" ,'
            .'    chim.description as "chim_description" ,'
            .'    chim.sequence as "chim_sequence" ,'
            .'    chim.score as "chim_score",'
            .'    chim.status as "chim_status" ,'
            .'    chim.type as "chim_type" ,'
            .'    chim.processed as "chim_processed" ,'
            .'    chim.response as "chim_response" ,'
            .'    chim.type_obs as "chim_type_obs" ,'
            .'    chim.required_photo as "chim_required_photo" ,'
            .'    chim.quant_photo as "chim_quant_photo" ,'
            .'    chim.user_id as "chim_user_id" ,'
            .'    chim.chit_id as "chim_chit_id" ,'
            .'    chim.sect_id as "chim_sect_id",'
            .'    chim.updated_at as "chim_updated_at" ,'
            .'    chim.photos as "chim_photos" ,'
            .'    sect.description as "sect_description" ,'
            .'    chit.description as "chit_description",'
            .'    case when chim."type" = \'S\' then '
            .'        case when chim.response = \'Y\' then (chim.score)::float'
            .'        else (0)::float end'
            .'    else'
            .'          case when chim.response = \'E\' then (chim.score)::float '
            .'        else '
            .'            case when chim.response = \'G\' then chim.score::float / (2)::float'
            .'            else (0)::float end'
            .'        end'
            .'    end as "chit.run_score"'
            .' from checklists_movs chmv '
            .'      left join checklists_itens_movs chim on chim.chmv_id = chmv.id '
            .'      left join sectors sect on sect.id = chim.sect_id  '
            .'      left join checklists_itens chit on chit.id = chim.chit_id ';
            
        DB::statement("CREATE OR REPLACE VIEW view_checklist_itens_movs_performeds AS $SQL");
    }

    public function down(): void {
        DB::statement('DROP VIEW IF EXISTS view_checklist_itens_movs_performeds');
    }
};

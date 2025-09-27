<?php

namespace App\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BaseRepository
{
    public $currobject;

    public function index()
    {
        return $this->currobject->query()->paginate(10);
    }

    public function findByIdSingle($id)
    {
        return $this->currobject = $this->currobject::where('id','=',$id)->first();
    }

    public function enable($item_id, $user_id)
    {
        $data = $this->findByIdSingle($item_id);
        $data->deleted_user_id = null;
        $data->deleted_at = null;
        $data->updated_user_id = $user_id;
        $data->deleted_at = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
        $data->save();
    }

    public function deleteID($id)
    {
        $data = $this->findByIdSingle($id);
        $data->deleted_at = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
        $data->deleted_by = Auth::user()->username;
        $data->save();
    }

}

<?php namespace App\Presenters;

use App\Http\Models\Com\Newscate;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RolePresenter
 *
 * @package namespace App\Presenters;
 */
class NewscatePresenter extends FractalPresenter
{
    protected $newscate;

    public function __construct(Newscate $newscate)
    {
        $this->newscate = $newscate;
    }

    public function getTransformer()
    {

    }

    public function treedata($treepath = '')
    {
        $data = $this->newscate->select('parent_id as pId','id','name')->orderBy('order')->get();
        $array = [];
        foreach($data as $v){
            $array[] = ['pId'=>$v->pId,'id'=>$v->id,'name'=>$v->name];
        }
        return json_encode($array);
    }
}

<?php

namespace App\Presenters;

use App\Http\Models\Com\Friendlink;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdminUserPresenter
 *
 * @package namespace App\Presenters;
 */
class FriendlinkPresenter extends FractalPresenter
{

    protected $friendlink;

    public function __construct(Friendlink $friendlink)
    {
        $this->friendlink = $friendlink;
    }
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
    }

    public function friendlink()
    {
        $html = [];
        $friendData= $this->friendlink->where('flag',1)->get();
        foreach ($friendData as $v){
            $html[] = "<a class=\"link\" href=\"{$v->url}\" target=\"_blank\" rel=\"nofollow\">{$v->name}</a>";
        }
        return implode('<span>|</span>',$html);
    }
}

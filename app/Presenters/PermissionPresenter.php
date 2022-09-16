<?php

namespace App\Presenters;

use App\Repositories\PermissionRepositoryEloquent;
use App\Transformers\PermissionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use Route,Auth;

/**
 * Class PermissionPresenter
 *
 * @package namespace App\Presenters;
 */
class PermissionPresenter extends FractalPresenter
{
    protected $permission;

    public function __construct(PermissionRepositoryEloquent $permission)
    {
        $this->permission = $permission;
    }


    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PermissionTransformer();
    }

    /**
     * top permission select
     * @param int $fid
     * @return string
     */
    public function topPermissionSelect($fid = 0)
    {
        $tops = $this->permission->topPermissions();
        $select = '<select class="col-xs-10 col-sm-5 input-sm" name="fid">';
        $select .= '<option value="0">--顶级模块--</option>';
        if($tops->count()) {
            foreach ($tops as $top) {
                if($top->id == $fid) {
                    $select .= '<option  value="' . $top->id . '" selected >' . $top->display_name.'</option>';
                } elseif($top->id != $fid) {
                    $select .= '<option  value="' . $top->id . '">' . $top->display_name.'</option>';
                }
                $subs = $this->permission->subPermissions($top->id);
                foreach($subs as $sub){
                    if($sub->id == $fid) {
                        $select .= '<option  value="' . $sub->id . '" selected >----' . $sub->display_name . '</option>';
                    } elseif($sub->id != $fid) {
                        $select .= '<option  value="' . $sub->id . '">----' . $sub->display_name . '</option>';
                    }
                }
            }
        }
        $select .= '</select>';
        return $select;
    }

    /**
     * 用户根据权限可见的菜单
     * @return string
     */
    public function menus()
    {
        $menus = $this->permission->menus();
        $language = \Session::get('language');
        if($language=='en'){
            $display_name = 'display_name_en';
        }else{
            $display_name = 'display_name';
        }

        $html = '';
        if($menus) {

            foreach ($menus as $menu) {
                if(($menu['name'] !== '#') && !Route::has($menu['name'])) {
                    continue;
                }

                $class = $aclass = $anext =  '';
                if(isset($menu['sub'])) {
                    $aclass = ' dropdown-toggle';
                    $anext = '<b class="arrow fa fa-angle-down"></b>';
                }

                if($menu['name'] == Route::currentRouteName()) {
                    $class .= ' active';
                }

                if(!Auth::guard('admin')->user()->is_super && !Auth::guard('admin')->user()->can($menu['name_true'])){
                    $class .= ' hide';
                }

                $html .= '<li class="'.$class.'">';
                $href = ($menu['name'] == '#') ? '' : route($menu['name']);
                if($href){
                    $html .= '<a class="menus-click"   data-url='.$href.' data-title='.$menu[$display_name].'  href="javascript:void(0)"  ><i class="layui-icon" lay-tips="'.$menu[$display_name].'">'.$menu['icon'].';</i><cite>'.$menu[$display_name].'</cite></a>';
                }else{
                    $html .= '<a  href="javascript:void(0)"  ><i class="layui-icon" lay-tips="'.$menu[$display_name].'">'.$menu['icon'].';</i><cite>'.$menu[$display_name].'</cite><i class="iconfont nav_right">&#xe697;</i></a>';
                }
                
                   

               

                if(!isset($menu['sub'])) {
                    $html .= '</li>';
                    continue;
                }

                $html .= '<ul class="sub-menu">';
                foreach ($menu['sub'] as $sub) {
                    $subclass = '';
                    if(($sub['name'] !== '#') && !Route::has($sub['name'])) {
                        continue;
                    }
                    $href = ($sub['name'] == '#') ? '#' : route($sub['name']);
                    $icon = $sub['icon_html'] ? $sub['icon_html'] : '<i class="iconfont left-nav-li" lay-tips="">&#xe6a7;</i>';

                    //if($sub['name'] == Route::currentRouteName()) {
                      //  $subclass .= ' active';
                   // }

                    $thirdmenu = '';
                    $isthirdmenu = false;
                    $dropclass = "";
                    $icondrop = "";
                    if(isset($sub['sub_permission'])){
                        $thirdmenu .= '<ul class="submenu nav-hide">';
                        foreach ($sub['sub_permission'] as $sub_permission) {
                            if($sub_permission['is_menu']==1){
                                $isthirdmenu = true;
                                $thirdhref = ($sub_permission['name'] == '#') ? '#' : route($sub_permission['name']);
                                $thirdmenu .= sprintf('<li class=""><a class="sub-menu-a" href="javascript:void(0)" data-url="%s"><i class="menu-icon fa fa-caret-right"></i> %s</a><b class="arrow"></b></li>', $thirdhref, $sub_permission[$display_name]);
                            }
                        }
                        $thirdmenu .= '</ul>';
                    }

                    if($isthirdmenu){
                        $dropclass = "dropdown-toggle";
                        $icondrop = "<b class=\"arrow fa fa-angle-down\"></b>";
                    }

                    if(!Auth::guard('admin')->user()->is_super && !Auth::guard('admin')->user()->can($sub['name_true'])){
                        // $html .= sprintf('<li class="%s hide"><a class="sub-menu-a %s" href="javascript:void(0)" data-url="%s">%s %s %s</a><b class="arrow"></b>%s</li>',$subclass,$dropclass, $href, $icon, $sub[$display_name],$icondrop,$thirdmenu);

                       
                    }else{
                        // $html .= sprintf('<li class="%s"><a class="sub-menu-a %s" href="javascript:void(0)" data-url="%s">%s %s %s</a><b class="arrow"></b>%s</li>',$subclass,$dropclass, $href, $icon, $sub[$display_name],$icondrop,$thirdmenu);
                      $icon=$sub['icon'];
                        $html .= "<li><a class='menus-click'  href='javascript:void(0)' data-url='$href' data-title='$sub[$display_name]' ><i class='layui-icon' lay-tips=''>$icon;</i><cite>$sub[$display_name]</cite></a> </li>";
                    }



                }
                $html .= '</ul>';
                $html .= '</li>';

            }
        }

        return $html;
    }
}

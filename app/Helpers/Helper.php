<?php
namespace App\Helpers;

use App\Models\Master\M_menu;
use App\Models\Master\M_menu_user;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function menuAllowTo()
    {
        $recursiveMenu = M_menu_user::where('id_user', 1)->get();
        
        $html = "";
        
        foreach ($recursiveMenu as $value) {
            $menu = M_menu::where('id_menu',$value->id_menu)->first();
            
            if($menu->status == 0){
                $html .= '<div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">' . $menu->nama_menu . '</span>
                    </div>
                </div>';
            }elseif($menu->status == 1){
                $html .= '<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-person fs-2"></i>
                        </span>
                        <span class="menu-title">' . $menu->nama_menu . '</span>
                        <span class="menu-arrow"></span>
                    </span>';

                    $child = M_menu::where('parent_id',$value->id_menu)->where('status',2)->get();

                    foreach($child as $item){
                        $html .= '<div class="menu-sub menu-sub-accordion menu-active-bg"><div class="menu-item">
                            <a class="menu-link" href="../../demo13/dist/account/overview.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">' . $item->nama_menu . '</span>
                            </a>
                        </div></div>';
                    }
                    
                    $html .= '</div>';
            }
            
        }

        return $html;
    }
}

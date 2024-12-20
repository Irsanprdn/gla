<?php
namespace App\Http\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;
use App\Models\Program;

class MenuComposer
{
    public function compose(View $view)
    {
        // Query to get menu data
        $menus = Program::leftJoin('programs as parent', function ($join) {
            $join->on('programs.parent_id', '=', 'parent.id')
                 ->where('parent.type', '=', 'parent'); // Asumsi tipe parent
        })
        ->select('programs.*', 'parent.name as parent_name')
        ->orderByRaw("
            CASE 
                WHEN programs.id = '1' THEN 1
                WHEN programs.parent_id = '1' THEN 1
                ELSE 0
            END
        ") // Parent & Child terkait authentication diurutkan paling bawah
        ->orderBy('programs.created_at', 'asc') // Sisanya diurutkan berdasarkan created_at
        ->get();
        $view->with('menus', $menus); // Share the data with the view
    }
}

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
        $menus  = Program::leftJoin('programs as parent', function ($join) {
            $join->on('programs.parent_id', '=', 'parent.id')
                 ->where('parent.type', '=', 'parent'); // Asumsi tipe parent
        })
        ->select('programs.*', 'parent.name as parent_name')
        ->orderByRaw('COALESCE(programs.parent_id, programs.id)')
        ->orderByRaw('CASE WHEN programs.parent_id IS NULL THEN 0 ELSE 1 END')
        ->orderBy('programs.id')
        ->get();
        $view->with('menus', $menus); // Share the data with the view
    }
}

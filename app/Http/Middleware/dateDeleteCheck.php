<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\task\taskController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class dateDeleteCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data = DB::table('task')->select('edate')->where('id',$request->id)->get();
        $date = date('Y-m-d',$data[0]->edate);
         if($date > date('Y-m-d')){
            return $next($request);
         }else{
            $message = "You cannot Delete an old / Finished Task ";
            session()->flash('Message-error', $message);
            return redirect(url('Tasks'));
         }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spipu\Html2Pdf\Html2Pdf;

class RelatorioController extends Controller
{
   public function __construct()
   {
     if (!Auth::check()) {
       return redirect('/');
     }

     $admin = Auth::user();
     if (!$admin->hasRole('admin')) {
       abort(404);
     }
   }

   public function index($id)
   {

     $admin = Auth::user();
     if (!$admin->hasRole('admin')) {
       abort(404);
     }
     /* MYSQL */
     $notificacoes = DB::table('notifications')
                       ->select(DB::raw("id, type, notifiable_id, notifiable_type,
                                     json_extract(data, '$.message_report') AS message_report,
                                     json_extract(data, '$.cod_proposta') AS cod_proposta,
                                     created_at
                                     "))
                       ->orderByRaw('created_at ASC')
                       ->get();

     /* POSTGRESSQL *//*
     $notificacoes = DB::table('notifications')
                       ->select(DB::raw("id, type, notifiable_id, notifiable_type,
                                     data ->> 'message_report' AS message_report,
                                     data ->> 'cod_proposta' AS cod_proposta,
                                     created_at
                                     "))
                       ->orderByRaw('created_at ASC')
                       ->get();
*/
     $notificacoesProposta = $notificacoes->where('cod_proposta', '=', $id);

     return view('relatorio', compact('notificacoesProposta'));
   }
/*
   public function printRelatorio($id)
   {

     ob_start();
     include dirname(__FILE__).'/relatorio.php';

     $content = ob_get_clean();
     $html2pdf = new Html2Pdf('P', 'A4', 'fr');
     $html2pdf->setDefaultFont('Arial');
     $html2pdf->writeHTML($content);
     $html2pdf->output('exemple00.pdf');
   }
*/
}

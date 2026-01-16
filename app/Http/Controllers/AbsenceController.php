<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index()
    {
        return view('admin.absences');
    }
       public function affichage()
    {
        return view('admin.index');
    }
          public function demande()
    {
        return view('admin.demande');
    }
              public function suivi_demande()
    {
        return view('admin.suivi_demande');
    }
    public function notes()
    {
        return view('admin.notes');
    }
        public function index_notes()
    {
        return view('admin.notes_index');
    }
}

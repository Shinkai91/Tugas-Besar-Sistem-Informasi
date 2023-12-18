<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
class QuestionController extends Controller
{
    public function ViewQuestion(Request $r) {
        $data = \DB::select("SELECT * FROM questions");

        return view('admin.question.data', [
            'data_questions' => $data
        ]);
    }

    public function AddQuestion(Request $r) {
        \DB::insert("INSERT INTO questions VALUES (null, '$r->name','$r->email','$r->phone','$r->subject')");
        return redirect(route('/'));
    }

    public function DeleteQuestion(Request $r,$id){
        Alert::success('Data Berhasil Dihapus');
        \DB::delete("DELETE FROM questions WHERE id = $id");
        return redirect(route('question.view'));
    }
}

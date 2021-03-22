<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Post;
class QuestionController extends Controller
{
    //

    public function find(Request $request, $user_id) {
        $retVal = [
            'status' => self::STATUS_FAIL,
            'result' => []
        ];
        try {
            $filters = $request->all();
    
            $userPosts = Post::where('user_id', $user_id)->get(['question_id'])->toArray();
            $query = Question::whereNotIn('id', array_column($userPosts, 'question_id'));
            
            if (array_key_exists('level', $filters)) {
                $query->where('questions.level', $filters['level']);
            }
    
            $retVal['result'] = $query->get()->toArray();
            $retVal['status'] = self::STATUS_SUCCESSFUL;
        } catch (\Throwable $th) {
            $retVal = [
                'status' => self::STATUS_FAIL,
                'result' => []
            ];
        }

        return $retVal;

        
    }
}

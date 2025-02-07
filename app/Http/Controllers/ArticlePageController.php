<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlePageController extends Controller
{
    public function ArticleFaq1(){
        $data = [
            'article_title' => 'How to Apply or Create a New Leave Application',
            'article_author' => 'BRPI IT Support Team',
            'article_date' => date('d M Y',01/17/2025),
        ];
        return view('articles.faqs.create_leave_app')->with($data);
    }

    public function ArticleFaq2(){
        return view('articles.faqs.leave_app_approval');
    }
}

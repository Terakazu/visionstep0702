<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
       
       $inputText = $request->input('goodpoint');
        $messages = [];

        if ($inputText != null) {
            $responseText = $this->generateResponse($inputText);

            $messages = [
                ['title' => '入力されたこと', 'content' => $inputText],
                ['title' => '関連する価値観', 'content' => $responseText]
            ];
        }

        return view('chat.create', ['messages' => $messages]);
    }
 
         public function generateResponse($inputText) {
        $result = OpenAI::completions()->create([
           'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => 'あなたが入力した良いことは次の通りです：「' . $inputText . '」。これに関連する価値観や大事にしていることを教えてください。また、他に関連する良いことを2つ挙げてください。',
            'temperature' => 0.8,
            'max_tokens' => 150,
        ]);
        
        return trim($result['choices'][0]['text']);
    }
}

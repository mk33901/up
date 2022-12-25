<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faqs = config('faq');
        // foreach($faqs as $faq)
        // {
        //     $isExist = Faq::where('question',$faq['question'])->first();
        //     if(!$isExist)
        //     {
        //         $faqModel = new Faq();
        //     }
        //     $faqModel->question = $faq['question'];
        //     $faqModel->answer = $faq['answer'];
        //     $faqModel->save();
        // }
        Faq::factory(100)->create();
    }
}

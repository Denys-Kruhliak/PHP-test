<?php
namespace Controllers;
use View\View;
use Models\Post;
use Models\User;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AppController{
    public function pdf(){
        $posts = Post::all();
        $mpdf = new \Mpdf\Mpdf();
        $style = file_get_contents('css/style.css');
        $mpdf->WriteHTML($style, \Mpdf\HTMLParserMode::HEADER_CSS);
        // $text = file_get_contents('db.txt');
        // $textTitle = '<h1>All Posts</h1>';
        // $mpdf->WriteHTML($textTitle);
        $mpdf->SetHeader('All Posts');
        $mpdf->SetFooter('|{PAGENO}|');
        
        foreach($posts as $post){
            $mpdf->AddPage();
            $text = '<div class="pdf">';
            $text .= '<h3>'.$post->getName().'</h3>';
            $text .= '<h6>'.$post->getAuthor()->getName().'</h6>';
            $text .= '<h6>'.$post->getCreated_at().'</h6>';
            $text .= '<p>'.$post->getText().'</p>';
            $text .= '</div>';
            $mpdf->WriteHTML($text);
        }
        
        $mpdf->Output('Test.pdf','D');
    }
    public function excelExport(){
        $users = User::All();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 1;
        foreach($users as $user){
            $sheet->fromArray(
                [$i,
                $user->getName(),
                $user->getEmail()],  
                NULL,
                'A'.$i++         
                             
            );
        }


        // $sheet = $spreadsheet->getActiveSheet();
        // $i = 1;
        // foreach($users as $user){
        //     $sheet->setCellValue('A'.$i, $user->getName());
        //     $sheet->setCellValue('B'.$i, $user->getEmail());
        //     $i++;
        // }
        
        
        $writer = new Xlsx($spreadsheet);
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"user1.xlsx\"");
        $writer->save('php://output');
        // View::render('home/index');
        exit;
    }
}

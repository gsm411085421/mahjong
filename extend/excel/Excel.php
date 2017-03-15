<?php
/**
 * Document : https://github.com/PHPOffice/PHPExcel/wiki/User%20Documentation
 */
namespace excel;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_RichText;
use PHPExcel_Style_Color;

class Excel extends PHPExcel
{


    public function say()
    {
        $objPHPExcel = new PHPExcel;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Hello')
                    ->setCellValue('B2', 'world!')
                    ->setCellValue('C1', 'Hello')
                    ->setCellValue('D2', 'world!');

        /*$objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValueByColumnAndRow($k,1, $v);*/

        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

        return $objPHPExcel;
    }
/**
 * 示例： 富文本
 * @return object PHPExcel
 */
    public function expRichText()
    {
        $objPHPExcel = new PHPExcel;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Hello');
        $objRichText = new PHPExcel_RichText();
        $objRichText->createText('你好 ');

        $objPayable = $objRichText->createTextRun('你 好 吗？');
        $objPayable->getFont()->setBold(true);
        $objPayable->getFont()->setItalic(true);
        $objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );

        $objRichText->createText(', unless specified otherwise on the invoice.');

        $objPHPExcel->getActiveSheet()->setCellValue('A13', 'Rich Text')
                                      ->setCellValue('C13', $objRichText);


        $objRichText2 = new PHPExcel_RichText();
        $objRichText2->createText("black text\n");

        $objRed = $objRichText2->createTextRun("red text");
        $objRed->getFont()->setColor( new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED  ) );
        // 自动列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getCell("C14")->setValue($objRichText2);
        $objPHPExcel->getActiveSheet()->getStyle("C14")->getAlignment()->setWrapText(true);
        return $objPHPExcel;
    }
/**
 * 示例： 公式
 * @return object
 */
    public function expFormulas()
    {
        $objPHPExcel = new PHPExcel;
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Range #1')
                                      ->setCellValue('B2', 3)
                                      ->setCellValue('B3', 7)
                                      ->setCellValue('B4', 13)
                                      ->setCellValue('B5', '=SUM(B2:B4)');
         $objPHPExcel->getActiveSheet()->getCell('B5')->getCalculatedValue();
         return $objPHPExcel;
    }
/**
 * 设置单元格背景色
 * @param \PHPExcel_Worksheet $worksheet worksheet 对象
 * @param string              $cell      单元格
 * @param string              $argb      argb值 ：'FFFF0000' 红色
 * @return object PHPExcel_Worksheet
 */
    public function setCellBgColor(\PHPExcel_Worksheet $worksheet, $cell, $argb)
    {
        $worksheet->getFill()->setFillType('solid');
        $worksheet->getStyle($cell)->getFill()->getStartColor()->setARGB($argb);
        return $worksheet;
    }
/**
 * 读文件
 * @param  string $filename 文件名
 * @return array
 */
    public function readFile($filename)
    {
        $Excel = PHPExcel_IOFactory::load($filename);
        // $Excel->setReadDataOnly(true);
        return $Excel->getActiveSheet()->toArray(null,false,false,false);
    }
/**
 * 保存到服务器
 * @param  PHPExcel $objPHPExcel [description]
 * @param  string   $filename    保存文件名，默认为当前日期
 * @param  string   $ext         保存文件类型 xls xlsx
 * @return [type]                [description]
 */
    public function save(PHPExcel $objPHPExcel, $filename='', $ext='xls')
    {
        if(!$filename) $filename = date('YmdHis').'.'.$ext;
        $createWriterType = '';
        switch($ext){
            case 'xls' : $createWriterType='Excel5';break;
            case 'xlsx': $createWriterType='Excel2007';break;
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $createWriterType);
        $objWriter->save($filename);
    }
/**
 * 下载到客户端
 * @param  PHPExcel $objPHPExcel [description]
 * @param  string   $filename    下载文件名
 * @param  string   $ext         文件类型 xls xlsx
 * @return [type]                [description]
 */
    public function download(PHPExcel $objPHPExcel, $filename='', $ext='xls')
    {
        if(!$filename) $filename = date('Y-m-d').'.'.$ext;

        $createWriterType = '';

        switch($ext){
            case 'xls' : 
                header('Content-Type: application/vnd.ms-excel');
                $createWriterType = 'Excel5';
                break;
            case 'xlsx': 
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $createWriterType = 'Excel2007';
                break;
            default : break;
        }
        
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $createWriterType);
        $objWriter->save('php://output');
    }
}
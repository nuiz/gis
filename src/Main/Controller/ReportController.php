<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;
use PHPExcel;
use PHPExcel_IOFactory;

class ReportController extends BaseController
{
  public function report(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $die_year = [];
    $reg_year = [];
    $persons = $db->select("person", ["die_date", "reg_date"]);

    foreach($persons as $person) {
      if(empty($person["die_date"]) || $person["die_date"] == "0000-00-00") continue;
      $year = explode("-", $person["die_date"]);
      $year = $year[0];
      $die_year[] = $year;
    }

    foreach($persons as $person) {
      if(empty($person["reg_date"]) || $person["reg_date"] == "0000-00-00") continue;
      $year = explode("-", $person["reg_date"]);
      $year = $year[0];
      $reg_year[] = $year;
    }

    return $container->view->render($res, "report/list.twig", [
      "die_year"=> $die_year,
      "reg_year"=> $reg_year,
    ]);
	}

  public function reportDie(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;
    $queryParams = $req->getQueryParams();
    $cYear = $queryParams["year"]-543;

    $where = [];
    $where["die_date[>=]"] = $cYear."-01-01 00:00:00";
    $where["die_date[<=]"] = $cYear."-12-31 23:59:59";
    $items = $db->select("person", "*", ["AND"=> $where]);

    $objWriter = $this->makeExcelBypersons($items);

    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');

    // It will be called file.xls
    header('Content-Disposition: attachment; filename="die-'.$queryParams["year"].'.xls"');

    // Write file to the browser
    $objWriter->save('php://output');

    exit();
  }

  public function reportReg(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;
    $queryParams = $req->getQueryParams();
    $cYear = $queryParams["year"]-543;

    $where = [];
    $where["reg_date[>=]"] = $cYear."-01-01 00:00:00";
    $where["reg_date[<=]"] = $cYear."-12-31 23:59:59";
    $items = $db->select("person", "*", ["AND"=> $where]);

    $objWriter = $this->makeExcelBypersons($items);

    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');

    // It will be called file.xls
    header('Content-Disposition: attachment; filename="reg-'.$queryParams["year"].'.xls"');

    // Write file to the browser
    $objWriter->save('php://output');

    exit();
  }

  public function makeExcelBypersons($items)
  {
    $excel = new PHPExcel();
    $excel->getProperties()->setCreator("gis-system");
    $excel->getProperties()->setLastModifiedBy("gis-system");
    $excel->getProperties()->setTitle("gis-system");
    $excel->getProperties()->setSubject("gis-system");
    $excel->getProperties()->setDescription("gis-system, report.");
    $excel->setActiveSheetIndex(0);

    $sheet = $excel->getActiveSheet();
    $sheet->setTitle("Report");

    foreach($items as $key => $item) {
      if($key == 0) {
        $sheet->SetCellValue('A'.'1', "ชื่อ");
        $sheet->SetCellValue('B'.'1', "นามสกุล");
        $sheet->SetCellValue('C'.'1', "วันเกิด");
        $sheet->SetCellValue('D'.'1', "ที่อยู่");
        $sheet->SetCellValue('E'.'1', "หมู่บ้าน");
        $sheet->SetCellValue('F'.'1', "ตำบล");
        $sheet->SetCellValue('G'.'1', "อำเภอ");
        $sheet->SetCellValue('H'.'1', "จังหวัด");
        $sheet->SetCellValue('I'.'1', "รหัสไปรษณีย์");
        $sheet->SetCellValue('J'.'1', "วันที่ลงทะเบียน");
        $sheet->SetCellValue('K'.'1', "วันที่เสียชีวิต");
      }

      $i = $key+2;

      $bTime = @strtotime($item["birth_date"]);
      $bYear = @date('Y', $bTime) + 543;
      $bStr = @date('d/m/', $bTime).$bYear;
      $bStr = $bStr?: "";

      $dTime = @strtotime($item["die_date"]);
      $dYear = @date('Y', $dTime) + 543;
      $dStr = @date('d/m/', $dTime).$dYear;
      $dStr = $dStr?: "";

      $rTime = @strtotime($item["die_date"]);
      $rYear = @date('Y', $rTime) + 543;
      $rStr = @date('d/m/', $rTime).$rYear;
      $rStr = $rStr?: "";

      $sheet->SetCellValue('A'.$i, $item["first_name"]);
      $sheet->SetCellValue('B'.$i, $item["last_name"]);
      $sheet->SetCellValue('C'.$i, $bStr);
      $sheet->SetCellValue('D'.$i, $item["address"]);
      $sheet->SetCellValue('E'.$i, $item["village"]);
      $sheet->SetCellValue('F'.$i, $item["district"]);
      $sheet->SetCellValue('G'.$i, $item["city"]);
      $sheet->SetCellValue('H'.$i, $item["province"]);
      $sheet->SetCellValue('I'.$i, $item["zipcode"]);
      $sheet->SetCellValue('J'.$i, $rStr);
      $sheet->SetCellValue('K'.$i, $dStr);
    }

    return PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    // $objWriter->save('test.xls');
  }
}

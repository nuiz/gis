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
        $sheet->SetCellValue('A'.'1', "เลขที่บัตรประชาชน");
        $sheet->SetCellValue('B'.'1', "ชื่อ");
        $sheet->SetCellValue('C'.'1', "นามสกุล");
        $sheet->SetCellValue('D'.'1', "วันเกิด");
        $sheet->SetCellValue('E'.'1', "ที่อยู่");
        $sheet->SetCellValue('F'.'1', "หมู่บ้าน");
        $sheet->SetCellValue('G'.'1', "ตำบล");
        $sheet->SetCellValue('H'.'1', "อำเภอ");
        $sheet->SetCellValue('I'.'1', "จังหวัด");
        $sheet->SetCellValue('J'.'1', "รหัสไปรษณีย์");
        $sheet->SetCellValue('K'.'1', "วันที่ลงทะเบียน");
        $sheet->SetCellValue('L'.'1', "วันที่เสียชีวิต");
      }

      $i = $key+2;

      $bTime = @strtotime($item["birth_date"]);
      $bYear = @date('Y', $bTime) + 543;
      $bStr = @date('d/m/', $bTime).$bYear;
      $bStr = !empty($item["birth_date"])? $bStr: "";

      $dTime = @strtotime($item["die_date"]);
      $dYear = @date('Y', $dTime) + 543;
      $dStr = @date('d/m/', $dTime).$dYear;
      $dStr = !empty($item["die_date"])? $dStr: "";

      $rTime = @strtotime($item["reg_date"]);
      $rYear = @date('Y', $rTime) + 543;
      $rStr = @date('d/m/', $rTime).$rYear;
      $rStr = !empty($item["reg_date"])? $rStr: "";

      $sheet->SetCellValue('A'.$i, $item["card_id"]);
      $sheet->SetCellValue('B'.$i, $item["first_name"]);
      $sheet->SetCellValue('C'.$i, $item["last_name"]);
      $sheet->SetCellValue('D'.$i, $bStr);
      $sheet->SetCellValue('E'.$i, $item["address"]);
      $sheet->SetCellValue('F'.$i, $item["village"]);
      $sheet->SetCellValue('G'.$i, $item["district"]);
      $sheet->SetCellValue('H'.$i, $item["city"]);
      $sheet->SetCellValue('I'.$i, $item["province"]);
      $sheet->SetCellValue('J'.$i, $item["zipcode"]);
      $sheet->SetCellValue('K'.$i, $rStr);
      $sheet->SetCellValue('L'.$i, $dStr);
    }

    return PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    // $objWriter->save('test.xls');
  }

  public function map(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    // $persons = $db->select("person", "*");
    $olders = $db->select("person", "*", ["is_older"=> 1]);
    $cripples = $db->select("person", ["[>]person_cripple" => ["id" => "person_id"]], "*",
      ["AND"=> ["person_cripple.cripple_id[!]"=> null], "GROUP"=> "person_cripple.person_id"]);
      // var_dump($cripples); exit();
    $disas = $db->select("person", ["[>]person_disavantaged" => ["id" => "person_id"]], "*",
      ["AND"=> ["person_disavantaged.disavantaged_id[!]"=> null], "GROUP"=> "person_disavantaged.person_id"]);
    $careergroups = $db->select("careergroup", "*");
    $scholars = $db->select("scholar", "*");

    return $container->view->render($res, "report/map.twig", [
      // "persons"=> $persons,
      "olders"=> $olders,
      "cripples"=> $cripples,
      "disas"=> $disas,
      "careergroups"=> $careergroups,
      "scholars"=> $scholars
    ]);
	}

  public function older(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $oldersService = XMLService::getInstance("olders");
    $olders = $oldersService->gets();

    foreach($olders as &$older) {
      $dateMin = new \DateTime('now');
      $dateMax = new \DateTime('now');

      $where = [];

      $dateMin->sub(new \DateInterval('P'.$older["min"].'Y'));
      $where["birth_date[<=]"] = $dateMin->format("Y-m-d");

      if($older["min"] < 90) {
        $dateMax->sub(new \DateInterval('P'.($older["max"] + 1).'Y'));
        $where["birth_date[>]"] = $dateMax->format("Y-m-d");
      }

      $where = ["AND"=> $where];
      $older["count"] = $db->count("person", ["AND"=> $where]);
    }

    return $container->view->render($res, "report/older.twig", ["olders"=> $olders, "today"=> $this->getToday()]);
  }

  public function cripple(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("cripple_type", "*");

    foreach($items as &$item) {
      $where = [];
      $where["cripple_id"] = $item["id"];
      $where = ["AND"=> $where];
      $item["count"] = $db->count("person_cripple", ["AND"=> $where]);
    }

    return $container->view->render($res, "report/cripple.twig", ["items"=> $items, "today"=> $this->getToday()]);
  }

  //disavantaged

  public function disavantaged(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("disavantaged_type", "*");

    foreach($items as &$item) {
      $where = [];
      $where["disavantaged_id"] = $item["id"];
      $where = ["AND"=> $where];
      $item["count"] = $db->count("person_disavantaged", ["AND"=> $where]);
    }

    return $container->view->render($res, "report/disavantaged.twig", ["items"=> $items, "today"=> $this->getToday()]);
  }

  public function register(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = [];
    $persons = $db->query("SELECT reg_date FROM person GROUP BY YEAR(reg_date)");

    foreach($persons as $person) {
      if(empty($person["reg_date"]) || $person["reg_date"] == "0000-00-00") continue;
      $year = explode("-", $person["reg_date"]);
      $year = $year[0];
      $date_start = $year."-01-01";
      $date_end = $year."-12-31";
      $item = [];
      $item["name"] = ($year + 543);
      $cripple = $db->select("person_cripple", "person_id", ["GROUP"=> "person_id"]);
      $disavantaged = $db->select("person_disavantaged", "person_id", ["GROUP"=> "person_id"]);
      $item["count_older"] = $db->count("person", ["AND"=> ["reg_date[>=]"=> $date_start, "reg_date[<]"=> $date_end, "is_older"=> 1]]);
      $item["count_cripple"] = $db->count("person", ["AND"=> ["reg_date[>=]"=> $date_start, "reg_date[<]"=> $date_end, "id"=> $cripple]]);
      $item["count_disavantaged"] = $db->count("person", ["AND"=> ["reg_date[>=]"=> $date_start, "reg_date[<]"=> $date_end, "id"=> $disavantaged]]);
      $items[] = $item;
    }

    return $container->view->render($res, "report/register.twig", ["items"=> $items, "today"=> $this->getToday()]);
  }

  public function dies(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = [];
    $persons = $db->query("SELECT die_date FROM person GROUP BY YEAR(die_date)");

    foreach($persons as $person) {
      if(empty($person["die_date"]) || $person["die_date"] == "0000-00-00") continue;
      $year = explode("-", $person["die_date"]);
      $year = $year[0];
      $date_start = $year."-01-01";
      $date_end = $year."-12-31";
      $item = [];
      $item["name"] = ($year + 543);
      $cripple = $db->select("person_cripple", "person_id", ["GROUP"=> "person_id"]);
      $disavantaged = $db->select("person_disavantaged", "person_id", ["GROUP"=> "person_id"]);
      $item["count_older"] = $db->count("person", ["AND"=> ["die_date[>=]"=> $date_start, "die_date[<]"=> $date_end, "is_older"=> 1]]);
      $item["count_cripple"] = $db->count("person", ["AND"=> ["die_date[>=]"=> $date_start, "die_date[<]"=> $date_end, "id"=> $cripple]]);
      $item["count_disavantaged"] = $db->count("person", ["AND"=> ["die_date[>=]"=> $date_start, "die_date[<]"=> $date_end, "id"=> $disavantaged]]);
      $items[] = $item;
    }

    return $container->view->render($res, "report/die.twig", ["items"=> $items, "today"=> $this->getToday()]);
  }

  // get thai now
  private $month = [
    "มกราคม",
    "กุมภาพันธ์",
    "มีนาคม",
    "เมษายน",
    "พฤษภาคม",
    "มิถุนายน",
    "กรกฎาคม",
    "สิงหาคม",
    "กันยายน",
    "ตุลาคม",
    "พฤศจิกายน",
    "ธันวาคม"
  ];
  public function getToday()
  {
    $nowY = (int)date("Y");
    $nowY += 543;
    $nowM = (int)date("m");
    $nowM = $this->month[$nowM-1];

    $nowStr = "วันที่ ".((int)date("d"))." ".$nowM."พ.ศ.".$nowY;
    return $nowStr;
  }
}

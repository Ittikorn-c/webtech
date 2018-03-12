<?php
  require('fpdf.php');
  session_start();

    class myPDF extends FPDF{

      function header(){
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'EVENT REPORT',0,0,'C');
        $this->Ln();
      }
      function footer(){
        if(isset($_SESSION['ses_userid'])){
          $ses_userid = $_SESSION['ses_userid'];            //สร้าง session สำหรับเก็บค่า ID
        }
        include('connect.php');
        $id = $ses_userid;
        $sql = "select user_firstname,user_lastname from userprofile WHERE userprofile.user_id = $id ";
        $result = $conn->query($sql);
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        while ($data = $result->fetch_assoc() ) {
          $this->Cell(0,10,$data['user_firstname'] .'  '. $data['user_lastname'],0,0,'C');
        }
      }
      function headerTable(){
        $this->SetY(40);
        $this->SetFont('Times','B',12);
        $this->Cell(60,10,'Event Name',1,0,'C');
        $this->Cell(40,10,'Category',1,0,'C');
        $this->Cell(30,10,'Type',1,0,'C');
        $this->Cell(45,10,'Location',1,0,'C');
        $this->Cell(40,10,'Date',1,0,'C');
        $this->Cell(30,10,'Visitors',1,0,'C');
        $this->Cell(35,10,'Total Income',1,0,'C');
        $this->Ln();
      }
      function data(){
        if(isset($_SESSION['ses_userid'])){
          $ses_userid = $_SESSION['ses_userid'];            //สร้าง session สำหรับเก็บค่า ID
        }
        include('connect.php');
        $id = $ses_userid;
        $sql = "select * from event_detail WHERE event_detail.user_id = $id ";
        $result = $conn->query($sql);
        while ($data = $result->fetch_assoc() ) {
          $this->Cell(60,10,ucfirst($data['event_name']),1,0,'C');
          $this->Cell(40,10,ucfirst($data['event_category']),1,0,'C');
          $this->Cell(30,10,ucfirst($data['event_type']),1,0,'C');
          $this->Cell(45,10,ucfirst($data['event_location']),1,0,'C');
          $this->Cell(40,10,$data['event_date'],1,0,'C');
          $this->Cell(30,10,$data['event_seat'],1,0,'C');
          $this->Cell(35,10,$data['event_price'] * $data['event_seat'],1,0,'C');
          $this->Ln();
        }
      }
    }

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->data();
    $pdf->Output();
  ?>

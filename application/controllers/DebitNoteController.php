<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DebitNoteController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata('ROLE_USERS')) || $this->session->userdata('ROLE_USERS') != 'Admin Debitnote') {
            redirect('login');
        }

        $this->load->model('DebitNote');
        $this->load->library(array('upload', 'emailing', 'notification', 'zip'));
        $this->load->helper('download');
    }
    public function vDN()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 0]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_raw', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function vDNGenerated()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 1]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_generate', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function vDNApproved()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 2]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_approved', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function vDNRejected()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 3]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_rejected', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function vDNProgress()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 4]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_progress', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function vDNOverdue()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 5]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_overdue', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function vDNFinished()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 6]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_finished', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function vDNReversed()
    {
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 7]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_reversed', $datas);
        $this->load->view('template/admin_dn/footer');
    }

    public function vDNMonitor()
    {
        $datas['debitnotes']   = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 6]);
        $datas['total']        = $this->DebitNote->getdn();
        $datas['ovdtotal']     = $this->DebitNote->getovddn();
        $datas['rcvtotal']     = $this->DebitNote->getrcvdn();
        $datas['ovdTwoYear']   = $this->DebitNote->getOvdPassTwoYear();
        $datas['rentCharge']   = $this->DebitNote->getRentCharge();
        $datas['rentOverdue']  = $this->DebitNote->getRentOverdue();
        $datas['utilCharge']   = $this->DebitNote->getUtilCharge();
        $datas['utilOverdue']  = $this->DebitNote->getUtilOverdue();
        $datas['othersCharge'] = $this->DebitNote->getOthersCharge();
        $datas['othersOverdue'] = $this->DebitNote->getOthersOverdue();
        $datas['year_list']    = $this->DebitNote->getYearDN();
        $datas['tahunan']      = $this->DebitNote->getTahunanDN();
        $datas['tahunan2020']  = $this->DebitNote->getTahunanDN2020();
        $datas['totalTahunan'] = $this->DebitNote->grandTotal();
        $datas['topTenants']   = $this->DebitNote->getTopTenantsDN();
        $datas['agingTiga']    = $this->DebitNote->getAgingTigaPuluh();
        $datas['agingTigaEnam'] = $this->DebitNote->getAgingTigaEnam();
        $datas['agingEnam']    = $this->DebitNote->getAgingEnamPuluh();

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_dashboard', $datas);
        $this->load->view('template/admin_dn/monitoringfooter', $datas);
    }

    public function vDNEdit($id)
    {
    }

    public function store()
    {
        $config['upload_path'] = './uploads/debitnote/fileUploaded/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['file_name'] = time();

        $this->upload->initialize($config);
        if (!empty($_FILES['FILEDN']['name'])) {
            if ($this->upload->do_upload('FILEDN')) {
                $fileDN         = $this->upload->data();
                $filePath       = './uploads/debitnote/fileUploaded/' . $fileDN['file_name'];
                $spreadsheet    = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $arrSpreadsheet = $spreadsheet->getActiveSheet()->toArray();
                $highestRow     = $spreadsheet->getActiveSheet()->getHighestRow();

                $value = $spreadsheet->getActiveSheet()->getCell('B5')->getValue();
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);

                $dataStore = array();
                for ($i = 4; $i < $highestRow; $i++) {
                    $date = date_create($arrSpreadsheet[$i][1]);

                    $data['ID_DEBITNOTE']               = 'DN_' . md5(time() . $this->getRandString(5));
                    $data['NOFAKTUR_DEBITNOTE']         = $arrSpreadsheet[$i][0];
                    $data['TGLFAKTUR_DEBITNOTE']        = date('Y-m-d', strtotime($arrSpreadsheet[$i][1]));
                    $data['TGLJATUH_DEBITNOTE']         = date('Y-m-d', strtotime($arrSpreadsheet[$i][2]));
                    $data['NOFAKTURPAJAK_DEBITNOTE']    = $arrSpreadsheet[$i][3];
                    $data['KURSPAJAK_DEBITNOTE']        = $arrSpreadsheet[$i][4];
                    $data['NOPELANGGAN_DEBITNOTE']      = $arrSpreadsheet[$i][5];
                    $data['EMAIL_DEBITNOTE']            = $arrSpreadsheet[$i][6];
                    $data['NOPESANAN_DEBITNOTE']        = $arrSpreadsheet[$i][7];
                    $data['TGLPESANAN_DEBITNOTE']       = date('Y-m-d', strtotime($arrSpreadsheet[$i][8]));
                    $data['MATAUANG']                   = $arrSpreadsheet[$i][9];
                    $data['NAMAPERUSAHAAN_DEBITNOTE']   = $arrSpreadsheet[$i][10];
                    $data['ALAMATPERUSAHAAN_DEBITNOTE'] = $arrSpreadsheet[$i][11];
                    $data['NPWP_DEBITNOTE']             = $arrSpreadsheet[$i][12];
                    $data['BARANGJASA_DEBITNOTE']       = $arrSpreadsheet[$i][13];
                    $data['HARGAJUAL_DEBITNOTE']        = str_replace(',', '', $arrSpreadsheet[$i][14]);
                    $data['TOTHARGAJUAL_DEBITNOTE']     = str_replace(',', '', $arrSpreadsheet[$i][15]);
                    $data['POTHARGA_DEBITNOTE']         = str_replace(',', '', $arrSpreadsheet[$i][16]);
                    $data['UANGMUKA_DEBITNOTE']         = str_replace(',', '', $arrSpreadsheet[$i][17]);
                    $data['HARGAPOTONGAN_DEBITNOTE']    = str_replace(',', '', $arrSpreadsheet[$i][18]);
                    $data['DPP_DEBITNOTE']              = str_replace(',', '', $arrSpreadsheet[$i][19]);
                    $data['PPN_DEBITNOTE']              = str_replace(',', '', $arrSpreadsheet[$i][20]);
                    $data['GRANDTOTAL_DEBITNOTE']       = str_replace(',', '', $arrSpreadsheet[$i][21]);
                    $data['TIPE_DEBITNOTE']             = $arrSpreadsheet[$i][22];
                    array_push($dataStore, $data);
                }
                $this->DebitNote->insertBatch($dataStore);
            } else {
                echo $this->upload->display_errors();
            }
        }
        redirect('debitnote');
    }
    public function edit($idDebitNote)
    {
        $datas['debitnote'] = $this->DebitNote->get(['ID_DEBITNOTE' => $idDebitNote]);

        $this->load->view('template/admin_dn/header');
        $this->load->view('template/admin_dn/sidebar');
        $this->load->view('template/admin_dn/topbar');
        $this->load->view('admin_dn/master_dn/dn_raw_edit', $datas);
        $this->load->view('template/admin_dn/footer');
    }
    public function update()
    {
        $datas = $_POST;

        $this->DebitNote->update($datas);
        redirect('debitnote');
    }
    public function destroyDN()
    {
        $this->DebitNote->delete(['ID_DEBITNOTE' => $_POST['ID_DEBITNOTE']]);
        redirect('debitnote');
    }
    public function destroyMultiDN()
    {
        $this->DebitNote->deleteMulti(explode(',', $_POST['ID_DEBITNOTE']));
        redirect('debitnote');
    }
    public function reverseDN()
    {
        $datas                      = $_POST;
        $datas['STAT_DEBITNOTE']    = '7';

        $page = $datas['page'];
        unset($datas['page']);

        $this->DebitNote->update($datas);
        redirect('debitnote/' . $page);
    }
    public function reverseMultiDN()
    {
        $datas['ID_DEBITNOTES']             = explode(',', $_POST['ID_DEBITNOTE']);
        $datas['STATUS']                    = '7';
        $datas['CATATANREVERSE_DEBITNOTE']  = $_POST['CATATANREVERSE_DEBITNOTE'];

        $this->DebitNote->updateStatusMulti($datas);
        redirect('debitnote/' . $_POST['page']);
    }
    public function finish()
    {
        $datas = $_POST;
        $datas['TGLBAYAR_DEBITNOTE'] = date('Y-m-d');

        $page = $datas['page'];
        unset($datas['page']);

        $this->DebitNote->update($datas);
        redirect('debitnote/' . $page);
    }
    public function finishMulti()
    {
        $param                  = $_POST;

        $page   = $param['page'];
        $datas['ID_DEBITNOTES']         = explode(',', $_POST['ID_DEBITNOTE']);
        $datas['STATUS']                = '6';
        $datas['TGLBAYAR_DEBITNOTE']    = date('Y-m-d');

        $this->DebitNote->updateStatusMulti($datas);
        redirect('debitnote/' . $page);
    }

    public function downloadTemplate()
    {
        force_download('./assets/templates/DEBITNOTE_TEMPLATE.xlsx', NULL);
    }

    public function downloadPdf()
    {
        $param = $_POST;
        $path = str_replace(base_url(), '', $param['PATH_DEBITNOTE']);
        force_download($path, NULL);
    }

    public function downloadExcel(){
        // === GET DATAS ====
        isset($_POST["year"]) ? $year = $_POST["year"] : $year = date("Y");
        $datas['total']         = $this->DebitNote->getdn();
        $datas['ovdtotal']      = $this->DebitNote->getovddn();
        $datas['rcvtotal']      = $this->DebitNote->getrcvdn();
        $datas['ovdTwoYear']    = $this->DebitNote->getOvdPassTwoYear();
        $datas['rentCharge']    = $this->DebitNote->getRentCharge();
        $datas['rentOverdue']   = $this->DebitNote->getRentOverdue();
        $datas['utilCharge']    = $this->DebitNote->getUtilCharge();
        $datas['utilOverdue']   = $this->DebitNote->getUtilOverdue();
        $datas['othersCharge']  = $this->DebitNote->getOthersCharge();
        $datas['othersOverdue'] = $this->DebitNote->getOthersOverdue();
        $datas['agingTiga']     = $this->DebitNote->getAgingTigaPuluh();
        $datas['agingTigaEnam'] = $this->DebitNote->getAgingTigaEnam();
        $datas['agingEnam']     = $this->DebitNote->getAgingEnamPuluh();
        $datas['topTenants']    = $this->DebitNote->getTopTenantsDN();
        
        // Yearly
        $reports            = $this->DebitNote->getAllReportSummary(['TAHUN_REPORTINGYEARLY' => $year, 'ORDER_DESC' => 'DESC']);
        $datas['yearly']['Listrik']   = 0;
        $datas['yearly']['Rent']      = 0;
        $datas['yearly']['Service']   = 0;
        $datas['yearly']['Air']       = 0;
        $datas['yearly']['Telefon']   = 0;
        $datas['yearly']['Others']    = 0;
        $datas['yearly']['GrandTotal'] = 0;
        
        $loop = 0;
        foreach ($reports as $item) {
            if($loop == 6){
                break;
            }
            $datas['yearly'][$item->TIPE_REPORTINGYEARLY] += $item->TARGETTOTAL_REPORTINGYEARLY;
            $loop++;
        }
        $datas['yearly']['GrandTotal'] = $datas['yearly']['Listrik'] + $datas['yearly']['Rent'] + $datas['yearly']['Service'] + $datas['yearly']['Air'] + $datas['yearly']['Telefon'] + $datas['yearly']['Others'];

        // YearlyDetail
        $reports    = $this->DebitNote->getAllReportSummary(['TAHUN_REPORTINGYEARLY' => $year]);
        $tahunTemp  = '';
        $yearlyDetail = array();
        foreach ($reports as $item) {
            if($item->TAHUNBAYAR_REPORTINGYEARLY != $tahunTemp){
                $tahunTemp = $item->TAHUNBAYAR_REPORTINGYEARLY;
                $yearlyDetail[$item->TAHUNBAYAR_REPORTINGYEARLY]            = array();
                $yearlyDetail[$item->TAHUNBAYAR_REPORTINGYEARLY]['Year']    = $item->TAHUNBAYAR_REPORTINGYEARLY;
            }
            $yearlyDetail[$item->TAHUNBAYAR_REPORTINGYEARLY][$item->TIPE_REPORTINGYEARLY] = $item->TOTAL_REPORTINGYEARLY;        
        }

        $datas['yearlyDetail']['totListrik'] = 0;
        $datas['yearlyDetail']['totRent']    = 0;
        $datas['yearlyDetail']['totService'] = 0;
        $datas['yearlyDetail']['totAir']     = 0;
        $datas['yearlyDetail']['totTelefon'] = 0;
        $datas['yearlyDetail']['totOthers']  = 0;
        $datas['yearlyDetail']['totGrand']   = 0;
        $dataTable  = array();

        // MonthlyDetail
        $monthly = $this->DebitNote->getmonthlydn($year);
        $received = $this->DebitNote->getBulanFinishDN($year);

        $terbitData = [];
        for ($i = 0; $i <= 11; $i++) {
            $terbitData[$i] = 0;
        };
        $bulan = 1;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            foreach ($monthly as $item) {
                if ($bulan == $item->BULAN) {
                    $terbitData[$bulan - 1] = $item->TOTAL;
                    break;
                } else if ($item->BULAN > $bulan) {
                    $terbitData[$bulan - 1] = 0;
                    break;
                }
            }
        };

        $receivedData = [];
        for ($i = 0; $i <= 11; $i++) {
            $receivedData[$i] = 0;
        };
        $bulan = 1;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            foreach ($received as $item) {
                if ($bulan == $item->BULAN) {
                    $receivedData[$bulan - 1] = $item->TOTAL;
                    break;
                } else if ($item->BULAN > $bulan) {
                    $receivedData[$bulan - 1] = 0;
                    break;
                }
            }
        };
        
        // DN Aging
        $cAgingTiga     = (!empty($datas['agingTiga']) ? $datas['agingTiga'] : 0);
        $cAgingTigaEnam = (!empty($datas['agingTigaEnam']) ? $datas['agingTigaEnam'] : 0);
        $cAgingEnam     = (!empty($datas['agingEnam']) ? $datas['agingEnam'] : 0);

        // Top Tenants
        $topTenantsData = [];
        foreach ($datas['topTenants'] as $items) {
            $topTenantsData[] = (int) $items->TOTAL;
        };

        $topTenantsLabel = [];
        foreach ($datas['topTenants'] as $items) {
            $topTenantsLabel[] = $items->NAMAPERUSAHAAN_DEBITNOTE;
        };

        // === STYLING SHEETS ===
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $styleHeading1['font']['bold'] = true;
        $styleHeading1['font']['size'] = 20;
        
        $styleHeading2['font']['bold'] = true;
        $styleHeading2['font']['size'] = 14;
        
        $styleHeading3['font']['bold'] = true;
        $styleHeading3['font']['size'] = 12;
        
        $styleTitle['font']['bold']                         = true;
        $styleTitle['font']['size']                         = 11;
        $styleTitle['font']['color']['argb']                = \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE;
        $styleTitle['fill']['fillType']                     = \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID;
        $styleTitle['fill']['color']['argb']                = '002060';
        $styleTitle['alignment']['horizontal']              = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
        $styleTitle['borders']['outline']['borderStyle']    = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;
        
        $styleContent['font']['size']                         = 11;
        $styleContent['borders']['outline']['borderStyle']    = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;
        
        $styleContentCenter['font']['size']                         = 11;
        $styleContentCenter['borders']['outline']['borderStyle']    = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;
        $styleContentCenter['alignment']['horizontal']              = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

        $sheet->getColumnDimension('A')->setWidth(38);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(20);
        $sheet->getColumnDimension('M')->setWidth(20);

        // === WRITE DATA ===
        $sheet->setCellValue('A1', 'DEBIT NOTE REPORT | '.date('j F Y'))->getStyle('A1')->applyFromArray($styleHeading1);
        // Account Recevables
        $sheet->setCellValue('A3', 'Account Receivables')->getStyle('A3')->applyFromArray($styleHeading2);
        $sheet->setCellValue('A4', 'Total DN')->getStyle('A4')->applyFromArray($styleTitle);
        $sheet->setCellValue('A5', 'Total Received DN')->getStyle('A5')->applyFromArray($styleTitle);
        $sheet->setCellValue('A6', 'Total Overdue DN')->getStyle('A6')->applyFromArray($styleTitle);
        $sheet->setCellValue('A7', 'Total Overdue pass due 2 years')->getStyle('A7')->applyFromArray($styleTitle);
        $sheet->setCellValue('B4', $datas['total'])->getStyle('B4')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('B5', $datas['rcvtotal'])->getStyle('B5')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('B6', $datas['ovdtotal'])->getStyle('B6')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('B7', $datas['ovdTwoYear'])->getStyle('B7')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        // Recevied & Unreceived
        $sheet->setCellValue('A9', 'Received & Unreceived')->getStyle('A9')->applyFromArray($styleHeading2);
        $sheet->setCellValue('A10', '')->getStyle('A10')->applyFromArray($styleTitle);
        $sheet->setCellValue('B10', 'Total')->getStyle('B10')->applyFromArray($styleTitle);
        $sheet->setCellValue('C10', 'Percentage %')->getStyle('C10')->applyFromArray($styleTitle);
        $sheet->setCellValue('A11', 'Received')->getStyle('A11')->applyFromArray($styleTitle);
        $sheet->setCellValue('A12', 'Overdue')->getStyle('A12')->applyFromArray($styleTitle);
        
        $cReceived = (!empty($datas['rcvtotal']) ? $datas['rcvtotal'] : 0);
        $sheet->setCellValue('B11', $cReceived)->getStyle('B11')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C11', '=ROUND((B11/B4) * 100, 0)')->getStyle('C11')->applyFromArray($styleContentCenter);
        
        $cOverdue = (!empty($datas['ovdtotal']) ? $datas['ovdtotal'] : 0);
        $sheet->setCellValue('B12', $cOverdue)->getStyle('B12')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C12', '=ROUND((B12/B4) * 100, 0)')->getStyle('C12')->applyFromArray($styleContentCenter);

        // Achivement Payment Received
        $sheet->setCellValue('A14', 'Achievement Payment Received')->getStyle('A14')->applyFromArray($styleHeading2);
        $sheet->setCellValue('A15', 'Sewa Bangunan')->getStyle('A15')->applyFromArray($styleHeading3);
        $sheet->setCellValue('A16', '')->getStyle('A16')->applyFromArray($styleTitle);
        $sheet->setCellValue('B16', 'Total')->getStyle('B16')->applyFromArray($styleTitle);
        $sheet->setCellValue('C16', 'Percentage %')->getStyle('C16')->applyFromArray($styleTitle);
        $sheet->setCellValue('A17', 'Done')->getStyle('A17')->applyFromArray($styleTitle);
        $sheet->setCellValue('A18', 'Not Yet')->getStyle('A18')->applyFromArray($styleTitle);

        $cRentCharge = (!empty($datas['rentCharge']) ? $datas['rentCharge'] : 0);
        $sheet->setCellValue('B17', $cRentCharge)->getStyle('B17')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C17', '=ROUND('.(float) ($datas['rentCharge'] / ($datas['rentCharge'] + $datas['rentOverdue']) * 100).', 0)')->getStyle('C17')->applyFromArray($styleContentCenter);
        
        $cRentOverdue = (!empty($datas['rentOverdue']) ? $datas['rentOverdue'] : 0);
        $sheet->setCellValue('B18', $cRentOverdue)->getStyle('B18')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C18', '=ROUND('.(float) ($datas['rentOverdue'] / ($datas['rentCharge'] + $datas['rentOverdue']) * 100).', 0)')->getStyle('C18')->applyFromArray($styleContentCenter);

        $sheet->setCellValue('A20', 'Utility')->getStyle('A20')->applyFromArray($styleHeading3);
        $sheet->setCellValue('A21', '')->getStyle('A21')->applyFromArray($styleTitle);
        $sheet->setCellValue('B21', 'Total')->getStyle('B21')->applyFromArray($styleTitle);
        $sheet->setCellValue('C21', 'Percentage %')->getStyle('C21')->applyFromArray($styleTitle);
        $sheet->setCellValue('A22', 'Done')->getStyle('A22')->applyFromArray($styleTitle);
        $sheet->setCellValue('A23', 'Not Yet')->getStyle('A23')->applyFromArray($styleTitle);

        $cUtilCharge = (!empty($datas['utilCharge']) ? $datas['utilCharge'] : 0);
        $sheet->setCellValue('B22', $cUtilCharge)->getStyle('B22')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C22', '=ROUND('.(float) ($datas['utilCharge'] / ($datas['utilCharge'] + $datas['utilOverdue']) * 100).', 0)')->getStyle('C22')->applyFromArray($styleContentCenter);

        $cUtilOverdue = (!empty($datas['utilOverdue']) ? $datas['utilOverdue'] : 0);
        $sheet->setCellValue('B23', $cUtilOverdue)->getStyle('B23')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C23', '=ROUND('.(float) ($datas['utilOverdue'] / ($datas['utilCharge'] + $datas['utilOverdue']) * 100).', 0)')->getStyle('C23')->applyFromArray($styleContentCenter);
        
        $sheet->setCellValue('A25', 'Others')->getStyle('A25')->applyFromArray($styleHeading3);
        $sheet->setCellValue('A26', '')->getStyle('A26')->applyFromArray($styleTitle);
        $sheet->setCellValue('B26', 'Total')->getStyle('B26')->applyFromArray($styleTitle);
        $sheet->setCellValue('C26', 'Percentage %')->getStyle('C26')->applyFromArray($styleTitle);
        $sheet->setCellValue('A27', 'Done')->getStyle('A27')->applyFromArray($styleTitle);
        $sheet->setCellValue('A28', 'Not Yet')->getStyle('A28')->applyFromArray($styleTitle);

        $cOthersCharge = (!empty($datas['othersCharge']) ? $datas['othersCharge'] : 0);
        $sheet->setCellValue('B27', $cOthersCharge)->getStyle('B27')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C27', '=ROUND('.(float) ($datas['othersCharge'] / ($datas['othersCharge'] + $datas['othersOverdue']) * 100).', 0)')->getStyle('C27')->applyFromArray($styleContentCenter);
        
        $cOthersOverdue = (!empty($datas['othersOverdue']) ? $datas['othersOverdue'] : 0);
        $sheet->setCellValue('B28', $cOthersOverdue)->getStyle('B28')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C28', '=ROUND('.(float) ($datas['othersOverdue'] / ($datas['othersCharge'] + $datas['othersOverdue']) * 100).', 0)')->getStyle('C28')->applyFromArray($styleContentCenter);
        // Payment Received Yearly
        $sheet->setCellValue('A30', 'Payment Received Yearly | '.$year)->getStyle('A30')->applyFromArray($styleHeading2);
        $sheet->setCellValue('A31', 'DN Payment')->getStyle('A31')->applyFromArray($styleHeading3);
        $sheet->setCellValue('A32', 'Target')->getStyle('A32')->applyFromArray($styleTitle);
        $sheet->setCellValue('B32', 'Listrik')->getStyle('B32')->applyFromArray($styleTitle);
        $sheet->setCellValue('C32', 'Rent')->getStyle('C32')->applyFromArray($styleTitle);
        $sheet->setCellValue('D32', 'Service')->getStyle('D32')->applyFromArray($styleTitle);
        $sheet->setCellValue('E32', 'Air')->getStyle('E32')->applyFromArray($styleTitle);
        $sheet->setCellValue('F32', 'Telefon')->getStyle('F32')->applyFromArray($styleTitle);
        $sheet->setCellValue('G32', 'Others')->getStyle('G32')->applyFromArray($styleTitle);
        $sheet->setCellValue('H32', 'Grand Total')->getStyle('H32')->applyFromArray($styleTitle);
        
        $sheet->setCellValue('A33', $year)->getStyle('A33')->applyFromArray($styleContentCenter);
        $sheet->setCellValue('B33', $datas['yearly']['Listrik'])->getStyle('B33')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C33', $datas['yearly']['Rent'])->getStyle('C33')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('D33', $datas['yearly']['Service'])->getStyle('D33')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('E33', $datas['yearly']['Air'])->getStyle('E33')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('F33', $datas['yearly']['Telefon'])->getStyle('F33')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('G33', $datas['yearly']['Others'])->getStyle('G33')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('H33', $datas['yearly']['GrandTotal'])->getStyle('H33')->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        
        $sheet->setCellValue('A35', 'DN Received')->getStyle('A35')->applyFromArray($styleHeading3);
        $sheet->setCellValue('A36', 'Tahun')->getStyle('A36')->applyFromArray($styleTitle);
        $sheet->setCellValue('B36', 'Listrik')->getStyle('B36')->applyFromArray($styleTitle);
        $sheet->setCellValue('C36', 'Rent')->getStyle('C36')->applyFromArray($styleTitle);
        $sheet->setCellValue('D36', 'Service')->getStyle('D36')->applyFromArray($styleTitle);
        $sheet->setCellValue('E36', 'Air')->getStyle('E36')->applyFromArray($styleTitle);
        $sheet->setCellValue('F36', 'Telefon')->getStyle('F36')->applyFromArray($styleTitle);
        $sheet->setCellValue('G36', 'Others')->getStyle('G36')->applyFromArray($styleTitle);
        $sheet->setCellValue('H36', 'Grand Total')->getStyle('H36')->applyFromArray($styleTitle);

        $lastRow = 36;
        foreach ($yearlyDetail as $item) {
            ++$lastRow;
            $listrik                                    = (!empty($item['Listrik']) ? $item['Listrik'] : '0');
            $datas['yearlyDetail']['totListrik']        += (!empty($item['Listrik']) ? $listrik : '0');
            $rent                                       = (!empty($item['Rent']) ? $item['Rent'] : '0');
            $datas['yearlyDetail']['totRent']           += (!empty($item['Listrik']) ? $rent : '0');
            $service                                    = (!empty($item['Service']) ? $item['Service'] : '0');
            $datas['yearlyDetail']['totService']        += (!empty($item['Listrik']) ? $service : '0');
            $air                                        = (!empty($item['Air']) ? $item['Air'] : '0');
            $datas['yearlyDetail']['totAir']            += (!empty($item['Listrik']) ? $air : '0');
            $telefon                                    = (!empty($item['Telefon']) ? $item['Telefon'] : '0');
            $datas['yearlyDetail']['totTelefon']        += (!empty($item['Listrik']) ? $telefon : '0');
            $others                                     = (!empty($item['Others']) ? $item['Others'] : '0');
            $datas['yearlyDetail']['totOthers']         += (!empty($item['Listrik']) ? $others : '0');
            $grandTotal                                 = (int)$listrik + (int)$rent + (int)$service + (int)$air + (int)$telefon + (int)$others;
            $datas['yearlyDetail']['totGrand']          += $grandTotal;
            
            $sheet->setCellValue('A'.$lastRow, $item['Year'])->getStyle('A'.$lastRow)->applyFromArray($styleContentCenter);
            $sheet->setCellValue('B'.$lastRow, $listrik)->getStyle('B'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
            $sheet->setCellValue('C'.$lastRow, $rent)->getStyle('C'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
            $sheet->setCellValue('D'.$lastRow, $service)->getStyle('D'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
            $sheet->setCellValue('E'.$lastRow, $air)->getStyle('E'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
            $sheet->setCellValue('F'.$lastRow, $telefon)->getStyle('F'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
            $sheet->setCellValue('G'.$lastRow, $others)->getStyle('G'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
            $sheet->setCellValue('H'.$lastRow, $grandTotal)->getStyle('H'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');

        }
        ++$lastRow;
        $sheet->setCellValue('A'.$lastRow, 'Total')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, $datas['yearlyDetail']['totListrik'])->getStyle('B'.$lastRow)->applyFromArray($styleTitle)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C'.$lastRow, $datas['yearlyDetail']['totRent'])->getStyle('C'.$lastRow)->applyFromArray($styleTitle)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('D'.$lastRow, $datas['yearlyDetail']['totService'])->getStyle('D'.$lastRow)->applyFromArray($styleTitle)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('E'.$lastRow, $datas['yearlyDetail']['totAir'])->getStyle('E'.$lastRow)->applyFromArray($styleTitle)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('F'.$lastRow, $datas['yearlyDetail']['totTelefon'])->getStyle('F'.$lastRow)->applyFromArray($styleTitle)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('G'.$lastRow, $datas['yearlyDetail']['totOthers'])->getStyle('G'.$lastRow)->applyFromArray($styleTitle)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('H'.$lastRow, $datas['yearlyDetail']['totGrand'])->getStyle('H'.$lastRow)->applyFromArray($styleTitle)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        // Payment Received Monthly
        ++$lastRow;
        $sheet->setCellValue('A'.++$lastRow, 'Payment Received Monthly | '.$year)->getStyle('A'.$lastRow)->applyFromArray($styleHeading2);
        $sheet->setCellValue('A'.++$lastRow, '')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, 'Januari')->getStyle('B'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('C'.$lastRow, 'Februari')->getStyle('C'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('D'.$lastRow, 'Maret')->getStyle('D'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('E'.$lastRow, 'April')->getStyle('E'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('F'.$lastRow, 'Mei')->getStyle('F'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('G'.$lastRow, 'Juni')->getStyle('G'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('H'.$lastRow, 'Juli')->getStyle('H'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('I'.$lastRow, 'Agustus')->getStyle('I'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('J'.$lastRow, 'September')->getStyle('J'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('K'.$lastRow, 'Oktober')->getStyle('K'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('L'.$lastRow, 'November')->getStyle('L'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('M'.$lastRow, 'Desember')->getStyle('M'.$lastRow)->applyFromArray($styleTitle);
        
        $sheet->setCellValue('A'.++$lastRow, 'DN Terbit')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, $terbitData[0])->getStyle('B'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C'.$lastRow, $terbitData[1])->getStyle('C'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('D'.$lastRow, $terbitData[2])->getStyle('D'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('E'.$lastRow, $terbitData[3])->getStyle('E'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('F'.$lastRow, $terbitData[4])->getStyle('F'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('G'.$lastRow, $terbitData[5])->getStyle('G'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('H'.$lastRow, $terbitData[6])->getStyle('H'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('I'.$lastRow, $terbitData[7])->getStyle('I'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('J'.$lastRow, $terbitData[8])->getStyle('J'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('K'.$lastRow, $terbitData[9])->getStyle('K'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('L'.$lastRow, $terbitData[10])->getStyle('L'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('M'.$lastRow, $terbitData[11])->getStyle('M'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');

        $sheet->setCellValue('A'.++$lastRow, 'Payment Received')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, $receivedData[0])->getStyle('B'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('C'.$lastRow, $receivedData[1])->getStyle('C'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('D'.$lastRow, $receivedData[2])->getStyle('D'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('E'.$lastRow, $receivedData[3])->getStyle('E'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('F'.$lastRow, $receivedData[4])->getStyle('F'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('G'.$lastRow, $receivedData[5])->getStyle('G'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('H'.$lastRow, $receivedData[6])->getStyle('H'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('I'.$lastRow, $receivedData[7])->getStyle('I'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('J'.$lastRow, $receivedData[8])->getStyle('J'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('K'.$lastRow, $receivedData[9])->getStyle('K'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('L'.$lastRow, $receivedData[10])->getStyle('L'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('M'.$lastRow, $receivedData[11])->getStyle('M'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        
        
        // DN Aging
        ++$lastRow;
        $sheet->setCellValue('A'.++$lastRow, 'DN Aging')->getStyle('A'.$lastRow)->applyFromArray($styleHeading2);
        $sheet->setCellValue('A'.++$lastRow, '<30 Hari')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, $cAgingTiga)->getStyle('B'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('A'.++$lastRow, '30-60 Hari')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, $cAgingTigaEnam)->getStyle('B'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        $sheet->setCellValue('A'.++$lastRow, '>60 Hari')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, $cAgingEnam)->getStyle('B'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
        
        // Top Tenants
        ++$lastRow;
        $sheet->setCellValue('A'.++$lastRow, 'Top Tenants')->getStyle('A'.$lastRow)->applyFromArray($styleHeading2);
        $sheet->setCellValue('A'.++$lastRow, 'Tenant')->getStyle('A'.$lastRow)->applyFromArray($styleTitle);
        $sheet->setCellValue('B'.$lastRow, 'Total')->getStyle('B'.$lastRow)->applyFromArray($styleTitle);
        
        $i = 0;
        foreach ($topTenantsData as $item) {
            ++$lastRow;
            $sheet->setCellValue('A'.$lastRow, $topTenantsLabel[$i])->getStyle('A'.$lastRow)->applyFromArray($styleContentCenter);
            $sheet->setCellValue('B'.$lastRow, $item)->getStyle('B'.$lastRow)->applyFromArray($styleContent)->getNumberFormat()->setFormatCode('_-* #,##0_-;-* #,##0_-;_-* "-"??_-;_-@_-');
            $i++;
        }
        
        $fileName = 'DEBITNOTE_REPORT_'.date('j F Y');
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function getRandString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateDN()
    {
        $param =  $_POST;

        $this->db->insert('DEBITNOTE_APPROVAL', ['ID_DEBITNOTE' => $param['ID_DEBITNOTE'], 'ROLE_APP' => 'Department Head']);
        $this->DebitNote->generate($param);

        $notif['title']     = 'Info Pengajuan Debit Note';
        $notif['message']   = 'Terdapat Pengajuan Debit Note';
        $notif['regisIds']  = $this->db->get_where('USERS', ['ROLE_USERS' => 'Department Head'])->result_array();
        $this->notification->push($notif);

        redirect('debitnote');
    }

    public function generateMultiDN()
    {
        $param      = explode(',', $_POST['ID_DEBITNOTE']);
        $dataStore  = array();

        foreach ($param as $item) {
            $temp['ID_DEBITNOTE']   = $item;
            $temp['ROLE_APP']       = 'Department Head';
            array_push($dataStore, $temp);
        }
        $this->db->insert_batch('DEBITNOTE_APPROVAL', $dataStore);
        $this->DebitNote->generateMulti($param);

        redirect('debitnote');
    }

    public function downloadMultiDN()
    {
        $param = explode(',', $_POST['ID_DEBITNOTE']);
        $debitNotes = $this->db->select('PATH_DEBITNOTE')->where_in('ID_DEBITNOTE', $param)->get('DEBITNOTE')->result();
        foreach ($debitNotes as $item) {
            $this->zip->read_file(str_replace(base_url(), '', $item->PATH_DEBITNOTE));
        }
        $this->zip->download(date('YmdHis') . '_Download Debitnotes.zip');
    }

    public function MonthlyDNChart()
    {
        isset($_POST["year"]) ? $year = $_POST["year"] : $year = date("Y");

        $terbitData = "";
        $receivedData = "";
        $bar_graph = "";

        $monthly = $this->DebitNote->getmonthlydn($year);
        $received = $this->DebitNote->getBulanFinishDN($year);

        $bulan = 1;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            foreach ($monthly as $item) {
                if ($bulan == $item->BULAN) {
                    $terbitData .= '"' . $item->TOTAL . '",';
                    break;
                } else if ($item->BULAN > $bulan) {
                    $terbitData .= '"' . 0 . '",';
                    break;
                }
            }
        }
        $terbitData = substr($terbitData, 0, -1);

        $bulan = 1;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            foreach ($received as $item) {
                if ($bulan == $item->BULAN) {
                    $receivedData .= '"' . $item->TOTAL . '",';
                    break;
                } else if ($item->BULAN > $bulan) {
                    $receivedData .= '"' . 0 . '",';
                    break;
                }
            }
        }
        $receivedData = substr($receivedData, 0, -1);

        $bar_graph = '
        <canvas id="graph" data-settings=
        \'
            {
                "labels": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", 
                "Aug", "Sep", "Oct", "Nov", "Des"],
                "datasets":[{
                    "label": "DN Terbit",
                    "backgroundColor": "rgba(252, 131, 56, 1)",
                    "borderColor": "rgba(252, 131, 56, 1)",                    
                    "borderWidth": "1",
                    "data": [' . $terbitData . ']
                },{
                    "label": "Payment Received",
                    "backgroundColor": "rgba(49, 176, 87, 1)",
                    "borderColor": "rgba(49, 176, 87, 1)",                    
                    "borderWidth": "1",
                    "data": [' . $receivedData . ']
                }]
            }
        \'
        ></canvas>';

        echo $bar_graph;
    }

    public function PaymentDNChart()
    {
        isset($_POST["year"]) ? $year = $_POST["year"] : $year = date("Y");
        $pay_graph = "";

        $reports                = $this->DebitNote->getAllReportSummary(['TAHUN_REPORTINGYEARLY' => $year]);
        $datas['tahun']         = array();
        $datas['ListrikSisa']   = array();
        $datas['ListrikTotal']  = array();
        $datas['RentSisa']      = array();
        $datas['RentTotal']     = array();
        $datas['ServiceSisa']   = array();
        $datas['ServiceTotal']  = array();
        $datas['AirSisa']       = array();
        $datas['AirTotal']      = array();
        $datas['TelefonSisa']   = array();
        $datas['TelefonTotal']  = array();
        $datas['OthersSisa']    = array();
        $datas['OthersTotal']   = array();


        foreach ($reports as $item) {
            if(empty($datas['tahun']) || end($datas['tahun']) != $item->TAHUNBAYAR_REPORTINGYEARLY){
                array_push($datas['tahun'], $item->TAHUNBAYAR_REPORTINGYEARLY);
            }
            array_push($datas[$item->TIPE_REPORTINGYEARLY."Total"], $item->TOTAL_REPORTINGYEARLY);
            array_push($datas[$item->TIPE_REPORTINGYEARLY."Sisa"], $item->TARGET_REPORTINGYEARLY - $item->TOTAL_REPORTINGYEARLY);
        }


        $pay_graph = '
        <canvas id="payGraph" data-settings=
        \'{
                "labels": ['.implode(',', $datas['tahun']).'],
                "datasets":[{
                    "label": "Listrik Terbayar",
                    "backgroundColor": "rgba(55, 126, 87, 1)",
                    "borderColor": "rgba(55, 126, 87, 1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['ListrikTotal']).'],
                    "stack": "Stack 0"
                },{
                    "label": "Listrik Belum Terbayar",
                    "borderColor": "rgba(99, 110, 114,1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['ListrikSisa']).'],
                    "stack": "Stack 0"
                },{
                    "label": "Rent Terbayar",
                    "backgroundColor": "rgba(49, 176, 155, 1)",
                    "borderColor": "rgba(49, 176, 155, 1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['RentTotal']).'],
                    "stack": "Stack 1"
                },{
                    "label": "Rent Belum Terbayar",
                    "borderColor": "rgba(99, 110, 114,1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['RentSisa']).'],
                    "stack": "Stack 1"
                },{
                    "label": "Service Terbayar",
                    "backgroundColor": "rgba(252, 131, 56, 1)",
                    "borderColor": "rgba(252, 131, 56, 1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['ServiceTotal']).'],
                    "stack": "Stack 2"
                },{
                    "label": "Service Belum Terbayar",
                    "borderColor": "rgba(99, 110, 114,1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['ServiceSisa']).'],
                    "stack": "Stack 2"
                },{
                    "label": "Air Terbayar",
                    "backgroundColor": "rgba(56, 139, 242, 1)",
                    "borderColor": "rgba(56, 139, 242, 1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['AirTotal']).'],
                    "stack": "Stack 3"
                },{
                    "label": "Air Belum Terbayar",
                    "borderColor": "rgba(99, 110, 114,1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['AirSisa']).'],
                    "stack": "Stack 3"
                },{
                    "label": "Telepon Terbayar",
                    "backgroundColor": "rgba(155, 176, 87, 1)",
                    "borderColor": "rgba(155, 176, 87, 1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['TelefonTotal']).'],
                    "stack": "Stack 4"
                },{
                    "label": "Telepon Belum Terbayar",
                    "borderColor": "rgba(99, 110, 114,1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['TelefonSisa']).'],
                    "stack": "Stack 4"
                },{
                    "label": "Others Terbayar",
                    "backgroundColor": "rgba(155, 176, 155, 1)",
                    "borderColor": "rgba(155, 176, 155, 1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['OthersTotal']).'],
                    "stack": "Stack 5"
                },{
                    "label": "Others Belum Terbayar",
                    "borderColor": "rgba(99, 110, 114,1)",                    
                    "borderWidth": "1",
                    "data": ['.implode(',', $datas['OthersSisa']).'],
                    "stack": "Stack 5"
                }]
            }
        \'
        ></canvas>';

        echo $pay_graph;
    }

    public function MonthlyTable()
    {
        isset($_POST["year"]) ? $year = $_POST["year"] : $year = date("Y");

        $monthly = $this->DebitNote->getmonthlydn($year);
        $received = $this->DebitNote->getBulanFinishDN($year);

        $terbitData = [];
        for ($i = 0; $i <= 11; $i++) {
            $terbitData[$i] = 0;
        };
        $bulan = 1;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            foreach ($monthly as $item) {
                if ($bulan == $item->BULAN) {
                    $terbitData[$bulan - 1] = $item->TOTAL;
                    break;
                } else if ($item->BULAN > $bulan) {
                    $terbitData[$bulan - 1] = 0;
                    break;
                }
            }
        };

        $receivedData = [];
        for ($i = 0; $i <= 11; $i++) {
            $receivedData[$i] = 0;
        };
        $bulan = 1;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            foreach ($received as $item) {
                if ($bulan == $item->BULAN) {
                    $receivedData[$bulan - 1] = $item->TOTAL;
                    break;
                } else if ($item->BULAN > $bulan) {
                    $receivedData[$bulan - 1] = 0;
                    break;
                }
            }
        };

        $dataList =
            '{
                "data": [
                    [
                        "DN Terbit",
                        "Rp. ' . number_format($terbitData[0], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[1], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[2], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[3], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[4], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[5], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[6], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[7], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[8], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[9], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[10], 0, ',', '.') . '",
                        "Rp. ' . number_format($terbitData[11], 0, ',', '.') . '"
                    ],
                    [
                        "Payment Received",
                        "Rp. ' . number_format($receivedData[0], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[1], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[2], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[3], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[4], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[5], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[6], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[7], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[8], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[9], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[10], 0, ',', '.') . '",
                        "Rp. ' . number_format($receivedData[11], 0, ',', '.') . '"
                    ]
                ]
            }';

        echo $dataList;
    }
    public function YearlyTable(){
        isset($_POST["year"]) ? $year = $_POST["year"] : $year = date("Y");

        $reports            = $this->DebitNote->getAllReportSummary(['TAHUN_REPORTINGYEARLY' => $year, 'ORDER_DESC' => 'DESC']);
        $tahunTemp          = '';
        $datas['Listrik']   = 0;
        $datas['Rent']      = 0;
        $datas['Service']   = 0;
        $datas['Air']       = 0;
        $datas['Telefon']   = 0;
        $datas['Others']    = 0;
        
        $loop = 0;
        foreach ($reports as $item) {
            if($loop == 6){
                break;
            }
            $datas[$item->TIPE_REPORTINGYEARLY] += $item->TARGETTOTAL_REPORTINGYEARLY;
            $loop++;
        }

        $dataList =
            '{
                "data": [
                    [

                        "'.$year.'",
                        "Rp. '.number_format($datas['Listrik'], 0, ',', '.').'",
                        "Rp. '.number_format($datas['Rent'], 0, ',', '.').'",
                        "Rp. '.number_format($datas['Service'], 0, ',', '.').'",
                        "Rp. '.number_format($datas['Air'], 0, ',', '.').'",
                        "Rp. '.number_format($datas['Telefon'], 0, ',', '.').'",
                        "Rp. '.number_format($datas['Others'], 0, ',', '.').'",
                        "Rp. '.number_format($datas['Listrik'] + $datas['Rent'] + $datas['Service'] + $datas['Air'] + $datas['Telefon'] + $datas['Others'], 0, ',', '.').'"
                    ]
                ]
            }';

        echo $dataList;
        // echo json_encode($datas);
    }

    public function YearlyDetailTable()
    {
        isset($_POST["year"]) ? $year = $_POST["year"] : $year = date("Y");

        $reports    = $this->DebitNote->getAllReportSummary(['TAHUN_REPORTINGYEARLY' => $year]);
        $tahunTemp  = '';
        $datas      = array();
        foreach ($reports as $item) {
            if($item->TAHUNBAYAR_REPORTINGYEARLY != $tahunTemp){
                $tahunTemp = $item->TAHUNBAYAR_REPORTINGYEARLY;
                $datas[$item->TAHUNBAYAR_REPORTINGYEARLY]            = array();
                $datas[$item->TAHUNBAYAR_REPORTINGYEARLY]['Year']    = $item->TAHUNBAYAR_REPORTINGYEARLY;
            }
            $datas[$item->TAHUNBAYAR_REPORTINGYEARLY][$item->TIPE_REPORTINGYEARLY] = $item->TOTAL_REPORTINGYEARLY;        
        }

        $totListrik = 0;
        $totRent    = 0;
        $totService = 0;
        $totAir     = 0;
        $totTelefon = 0;
        $totOthers  = 0;
        $totGrand   = 0;
        $dataTable  = array();
        foreach ($datas as $item) {
            $listrik        = (!empty($item['Listrik']) ? $item['Listrik'] : '0');
            $totListrik     += (!empty($item['Listrik']) ? $listrik : '0');
            $rent           = (!empty($item['Rent']) ? $item['Rent'] : '0');
            $totRent        += (!empty($item['Listrik']) ? $rent : '0');
            $service        = (!empty($item['Service']) ? $item['Service'] : '0');
            $totService     += (!empty($item['Listrik']) ? $service : '0');
            $air            = (!empty($item['Air']) ? $item['Air'] : '0');
            $totAir         += (!empty($item['Listrik']) ? $air : '0');
            $telefon        = (!empty($item['Telefon']) ? $item['Telefon'] : '0');
            $totTelefon     += (!empty($item['Listrik']) ? $telefon : '0');
            $others         = (!empty($item['Others']) ? $item['Others'] : '0');
            $totOthers      += (!empty($item['Listrik']) ? $others : '0');
            $grandTotal     = (int)$listrik + (int)$rent + (int)$service + (int)$air + (int)$telefon + (int)$others;
            $totGrand       += $grandTotal;
            
            $temp = '
                [

                    "'.$item['Year'].'",
                    "Rp. '.number_format($listrik, 0, ',', '.').'",
                    "Rp. '.number_format($rent, 0, ',', '.').'",
                    "Rp. '.number_format($service, 0, ',', '.').'",
                    "Rp. '.number_format($air, 0, ',', '.').'",
                    "Rp. '.number_format($telefon, 0, ',', '.').'",
                    "Rp. '.number_format($others, 0, ',', '.').'",
                    "Rp. '.number_format($grandTotal, 0, ',', '.').'"
                ]
            ';
            array_push($dataTable, $temp);
        }

        $dataList =
            '{
                "data": [
                    '.implode(',', $dataTable).'
                ]
            }';

        echo $dataList;
    }
}

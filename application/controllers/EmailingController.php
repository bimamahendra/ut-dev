<?php
    class EmailingController extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model('DebitNote');
            $config = [
                'mailtype'      => 'html',
                'charset'       => 'utf-8',
                'protocol'      => 'smtp',
                'smtp_host'     => 'smtp.gmail.com',
                'smtp_user'     => '', 
                'smtp_pass'     => '', 
                'smtp_crypto'   => 'ssl',
                'smtp_port'     => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];
            $this->load->library('email', $config);
        }

        public function sendEmail(){
            $param    = $_POST;
            
            $date = date('Y-m-d');
            $this->DebitNote->update(['ID_DEBITNOTE' => $param['ID_DEBITNOTE'], 'STAT_DEBITNOTE' => '4', 'TGLPUBLISHED_DEBITNOTE' => $date]);

            $filter['EMAIL_DEBITNOTE']          = $param['EMAIL_DEBITNOTE'];
            $filter['whereIn']['table']         = 'STAT_DEBITNOTE';
            $filter['whereIn']['values']        = array('4','5');
            $filter['orderBy']                  = 'EMAIL_DEBITNOTE ASC, TGLJATUH_DEBITNOTE DESC';
            $debitNotes = $this->DebitNote->getReminder($filter);
            
            if($debitNotes != null){
                $dnEmail            = '';
                $dn['email']        = array();

                foreach ($debitNotes as $item) {
                    if($dnEmail != $item->EMAIL_DEBITNOTE){
                        $dnEmail                    = $item->EMAIL_DEBITNOTE;
                        $dn['dataHtml'][$dnEmail]   = array();
                        $dn['attach'][$dnEmail]     = array();
                        array_push($dn['email'], $dnEmail);
                    }
                    array_push($dn['dataHtml'][$dnEmail], $item);
                    array_push($dn['attach'][$dnEmail], $item->PATH_DEBITNOTE);
                }
                
                foreach ($dn['email'] as $item) {
                    $email['from']      = 'Menara Astra';
                    $email['to']        = $item;
                    $email['subject']   = 'Menara Astra: Payment Reminder';
                    $email['message']   = $this->htmlPaymentProgress($dn['dataHtml'][$item]);
                    $email['attach']    = $dn['attach'][$item];
                    $this->send($email);
                }
            }

            redirect('debitnote/approved');
        }

        public function paymentProgress($period){
            $date = date('Y-m-d', strtotime('-'.$period.' day'));

            $filter['TGLPUBLISHED_DEBITNOTE']   = $date;
            $filter['whereIn']['table']         = 'STAT_DEBITNOTE';
            $filter['whereIn']['values']        = array('4','5');
            $filter['orderBy']                  = 'EMAIL_DEBITNOTE ASC, TGLJATUH_DEBITNOTE DESC';
            $debitNotes = $this->DebitNote->getReminder($filter);
            if($debitNotes != null){
                $dnEmail            = '';
                $dn['email']        = array();

                foreach ($debitNotes as $item) {
                    if($dnEmail != $item->EMAIL_DEBITNOTE){
                        $dnEmail                    = $item->EMAIL_DEBITNOTE;
                        $dn['dataHtml'][$dnEmail]   = array();
                        $dn['attach'][$dnEmail]     = array();
                        array_push($dn['email'], $dnEmail);
                    }
                    array_push($dn['dataHtml'][$dnEmail], $item);
                    array_push($dn['attach'][$dnEmail], $item->PATH_DEBITNOTE);
                }
                
                foreach ($dn['email'] as $item) {
                    $email['from']      = 'Menara Astra';
                    $email['to']        = $item;
                    $email['subject']   = 'Menara Astra: Payment Reminder';
                    $email['message']   = $this->htmlPaymentProgress($dn['dataHtml'][$item]);
                    $email['attach']    = $dn['attach'][$item];
                    $this->send($email);
                }
            }

        }

        public function paymentOverdue($period){
            $date = date('Y-m-d', strtotime('-'.$period.' day'));
            
            $filter['TGLJATUH_DEBITNOTE']           = $date;
            $filter['whereIn']['table']             = 'STAT_DEBITNOTE';
            $filter['whereIn']['values']            = array('4','5');
            $filter['orderBy']                      = 'EMAIL_DEBITNOTE ASC, TGLJATUH_DEBITNOTE DESC';
            $debitNotes = $this->DebitNote->getReminder($filter);

            if($debitNotes != null){
                $dnEmail            = '';
                $dn['email']        = array();

                foreach ($debitNotes as $item) {
                    if($dnEmail != $item->EMAIL_DEBITNOTE){
                        $dnEmail                    = $item->EMAIL_DEBITNOTE;
                        $dn['dataHtml'][$dnEmail]   = array();
                        $dn['attach'][$dnEmail]     = array();
                        array_push($dn['email'], $dnEmail);
                    }
                    array_push($dn['dataHtml'][$dnEmail], $item);
                    array_push($dn['attach'][$dnEmail], $item->PATH_DEBITNOTE);
                }
                
                foreach ($dn['email'] as $item) {
                    $email['from']      = 'Menara Astra';
                    $email['to']        = $item;
                    $email['subject']   = 'Menara Astra: Overdue Payment Confirmation';
                    $email['message']   = $this->htmlPaymentOverdue($dn['dataHtml'][$item]);
                    $email['attach']    = $dn['attach'][$item];
                    $this->send($email);
                }
            }
            // print_r($filter);
        }

        public function send($param){
            $this->email->clear(TRUE);
            $this->email->from($param['from']);
            $this->email->to($param['to']);
            $this->email->subject($param['subject']);
            $this->email->message($param['message']);
            if(!empty($param['attach'])){
                foreach ($param['attach'] as $item) {
                    $this->email->attach($item);
                }
            }
            
            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        }

        public function htmlPaymentProgress($param){
            $html = '
                <p>Attn: Mr/Mrs PT United Tractors Tbk</p>
                <p>Dear Sir/Madam,</p>
                <br>
                <p>Warmest greetings from Menara Astra,</p>
                <br>
                <p>This is a gentle reminder to infrom you that the invoices listed below will be due in the next few days: </p>
                <br>
                <table border="1" style="border-collapse: collapse;">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 17%">Invoice No</th>
                        <th style="width: 13%">Invoice Date</th>
                        <th style="width: 30%">Invoice Description</th>
                        <th style="width: 8%">Currency</th>
                        <th style="width: 14%">Amount</th>
                        <th style="width: 13%">Due Date</th>
                    </tr>
            ';

            $no = 1;
            foreach ($param as $item) {
                $dateInvoice = date_create($item->TGLFAKTUR_DEBITNOTE);
                $dateDueDate = date_create($item->TGLJATUH_DEBITNOTE);

                $html .= '
                    <tr>
                        <td style="text-align: center;">'.$no.'</td>
                        <td style="text-align: center;">'.$item->NOFAKTURPAJAK_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.date_format($dateInvoice, 'j F Y').'</td>
                        <td> '.$item->BARANGJASA_DEBITNOTE.' </td>
                        <td style="text-align: center;">'.$item->MATAUANG.'</td>
                        <td style="text-align: center;">'.number_format($item->GRANDTOTAL_DEBITNOTE).'</td>
                        <td style="text-align: center;">'.date_format($dateDueDate, 'j F Y').'</td>
                    </tr>
                ';
                $no++;
            }
            
            $html .= '
                </table>
                <br>
                <p>To avoid any late penalties, please make the payment no later than the invoice due date.</p>
                <p>The payment should be transfer, referring the invoice number, directly to our accoutn as below:</p>
                <table>
                    <tr>
                        <td>Bank Name</td>
                        <td>:</td>
                        <td>Bank Permata - Royal Sunter</td>
                    </tr>
                    <tr>
                        <td>Bank/Virtual Account Number</td>
                        <td>:</td>
                        <td>0.975.270.750</td>
                    </tr>
                    <tr>
                        <td>Benefeciary/Account Name</td>
                        <td>:</td>
                        <td>PT. MENARA ASTRA</td>
                    </tr>
                </table>
                <br>
                <div>If the payment has already been made please disregard this reminder and kindly inform us the proof of the payment.</div>
                <div></div>
                <div>Shall you have any question or further information, please contact us at +62 21 50821999 ext. 1107 or by email to <a href="mailto:billing@menara-astra.co.id">billing@menara-astra.co.id</a> and <a href="mailto:irma.yuniarti@menara-astra.co.id">irma.yuniarti@menara-astra.co.id</a></div>
                <div>Thank you for your kind attention and coorperation.</div>
                <br>
                <div>Sincerely,</div>
                <div><b>Menara Astra</b></div>
            ';
            return $html;
        }

        public function htmlPaymentOverdue($param){
            $html = '
                <p>Attn: Mr/Mrs PT United Tractors Tbk</p>
                <p>Dear Sir/Madam,</p>
                <br>
                <p>Warmest greetings from Menara Astra,</p>
                <br>
                <p>We would like to inform you that according to the payment schedule, the invoices listed below has been overdue. </p>
                <br>
                <table border="1" style="border-collapse: collapse;">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 17%">Invoice No</th>
                        <th style="width: 13%">Invoice Date</th>
                        <th style="width: 30%">Invoice Description</th>
                        <th style="width: 8%">Currency</th>
                        <th style="width: 14%">Amount</th>
                        <th style="width: 13%">Due Date</th>
                    </tr>
            ';

            $no = 1;
            foreach ($param as $item) {
                $dateInvoice = date_create($item->TGLFAKTUR_DEBITNOTE);
                $dateDueDate = date_create($item->TGLJATUH_DEBITNOTE);

                $html .= '
                    <tr>
                        <td style="text-align: center;">'.$no.'</td>
                        <td style="text-align: center;">'.$item->NOFAKTURPAJAK_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.date_format($dateInvoice, 'j F Y').'</td>
                        <td> '.$item->BARANGJASA_DEBITNOTE.' </td>
                        <td style="text-align: center;">'.$item->MATAUANG.'</td>
                        <td style="text-align: center;">'.number_format($item->GRANDTOTAL_DEBITNOTE).'</td>
                        <td style="text-align: center;">'.date_format($dateDueDate, 'j F Y').'</td>
                    </tr>
                ';
                $no++;
            }
            $html .= '
                </table>
                <br>
                <p>Late payment from the due date will be subject to penalites based on applicable term and condition of the agrement.</p>
                <p>To avoid increasing late penalties, please make payments immeadiately directly to our account as below:</p>
                <table>
                    <tr>
                        <td>Bank Name</td>
                        <td>:</td>
                        <td>Bank Permata - Royal Sunter</td>
                    </tr>
                    <tr>
                        <td>Bank/Virtual Account Number</td>
                        <td>:</td>
                        <td>0.975.270.750</td>
                    </tr>
                    <tr>
                        <td>Benefeciary/Account Name</td>
                        <td>:</td>
                        <td>PT. MENARA ASTRA</td>
                    </tr>
                </table>
                <br>
                <div>If the payment has already been made please disregard this reminder and kindly inform us the proof of the payment.</div>
                <div></div>
                <div>Shall you have any question or further information, please contact us at +62 21 50821999 ext. 1107 or by email to <a href="mailto:billing@menara-astra.co.id">billing@menara-astra.co.id</a> and <a href="mailto:irma.yuniarti@menara-astra.co.id">irma.yuniarti@menara-astra.co.id</a></div>
                <div>Thank you for your kind attention and coorperation.</div>
                <br>
                <div>Sincerely,</div>
                <div><b>Menara Astra</b></div>
            ';
            return $html;
        }
    }
    
?>
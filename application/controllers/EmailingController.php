<?php
    class EmailingController extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model('DebitNote');
        }

        public function sendEmail(){
            $idDebitNote    = $_POST['ID_DEBITNOTE'];
            $debitNote      = $this->DebitNote->get(['ID_DEBITNOTE' => $idDebitNote]);
            
            $email['from']      = 'Menara Astra';
            $email['to']        = $debitNote->EMAIL_DEBITNOTE;
            $email['subject']   = 'Menara Astra: Payment Detail';
            $email['message']   = 'Tes';
            $this->send($email);

            $date = date('Y-m-d');
            $this->DebitNote->update(['ID_DEBITNOTE' => $idDebitNote, 'STAT_DEBITNOTE' => '4', 'TGL_PUBLISHED' => $date]);
            redirect('debitnote/approved');
        }

        public function reminder(){
            $this->paymentProgress('14');
            $this->paymentProgress('21');
            $this->paymentProgress('27');

            $this->paymentOverdue('1');
            $this->paymentOverdue('14');
            $this->paymentOverdue('30');
        }

        public function paymentProgress($period){
            $date = date('Y-m-d', strtotime('-'.$period.' day'));
            
            $debitNotes = $this->DebitNote->getAll(['STAT_DEBITNOTE' => '4', 'TGLPUBLISHED_DEBITNOTE' => $date]);
            if($debitNotes != null){
                foreach ($debitNotes as $item) {
                    $email['from']      = 'Menara Astra';
                    $email['to']        = $item->EMAIL_DEBITNOTE;
                    $email['subject']   = 'Menara Astra: Payment Reminder';
                    $email['message']   = $this->htmlPaymentProgress($item);
                    $this->send($email);
                }
            }

        }

        public function paymentOverdue($period){
            $date = date('Y-m-d', strtotime('-'.$period.' day'));
            
            $debitNotes = $this->DebitNote->getAll(['STAT_DEBITNOTE' => '5', 'TGLJATUH_DEBITNOTE' => $date]);
            if($debitNotes != null){
                foreach ($debitNotes as $item) {
                    $email['from']      = 'Menara Astra';
                    $email['to']        = $item->EMAIL_DEBITNOTE;
                    $email['subject']   = 'Menara Astra: Overdue Payment Confirmation';
                    $email['message']   = $this->htmlPaymentOverdue($item);
                    $this->send($email);
                }
            }
        }

        public function send($param){
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
            $this->email->from($param['from']);
            $this->email->to($param['to']);
            $this->email->subject($param['subject']);
            $this->email->message($param['message']);
            if(!empty($param['attach'])){
                $this->email->attach($param['attach']);
            }
            
            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        }

        public function htmlPaymentProgress($param){
            $dateInvoice = date_create($param->TGLFAKTUR_DEBITNOTE);
            $dateDueDate = date_create($param->TGLJATUH_DEBITNOTE);
            return '
                <p>Attn: Mr/Mrs PT United Tractors Tbk</p>
                <p>Dear Sir/Madam,</p>
                <br>
                <p>Warmest greetings from Menara Astra,</p>
                <br>
                <p>This is a gentle reminder to infrom you that the invoices listed below will be due in the next few days: </p>
                <br>
                <table border="1">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 17%">Invoice No</th>
                        <th style="width: 13%">Invoice Date</th>
                        <th style="width: 30%">Invoice Description</th>
                        <th style="width: 8%">Currency</th>
                        <th style="width: 14%">Amount</th>
                        <th style="width: 13%">Due Date</th>
                    </tr>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">'.$param->NOFAKTURPAJAK_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.date_format($dateInvoice, 'j F Y').'</td>
                        <td>'.$param->BARANGJASA_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.$param->MATAUANG.'</td>
                        <td style="text-align: center;">'.$param->GRANDTOTAL_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.date_format($dateDueDate, 'j F Y').'</td>
                    </tr>
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
        }

        public function htmlPaymentOverdue($param){
            $dateInvoice = date_create($param->TGLFAKTUR_DEBITNOTE);
            $dateDueDate = date_create($param->TGLJATUH_DEBITNOTE);
            return '
                <p>Attn: Mr/Mrs PT United Tractors Tbk</p>
                <p>Dear Sir/Madam,</p>
                <br>
                <p>Warmest greetings from Menara Astra,</p>
                <br>
                <p>We would like to inform you that according to the payment schedule, the invoices listed below has been overdue. </p>
                <br>
                <table border="1">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 17%">Invoice No</th>
                        <th style="width: 13%">Invoice Date</th>
                        <th style="width: 30%">Invoice Description</th>
                        <th style="width: 8%">Currency</th>
                        <th style="width: 14%">Amount</th>
                        <th style="width: 13%">Due Date</th>
                    </tr>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">'.$param->NOFAKTURPAJAK_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.date_format($dateInvoice, 'j F Y').'</td>
                        <td>'.$param->BARANGJASA_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.$param->MATAUANG.'</td>
                        <td style="text-align: center;">'.$param->GRANDTOTAL_DEBITNOTE.'</td>
                        <td style="text-align: center;">'.date_format($dateDueDate, 'j F Y').'</td>
                    </tr>
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
        }
    }
    
?>
<?php
    class Emailing {
        public function send($param){
            $config = [
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => 'ilhaja94@gmail.com',  // Email gmail
                'smtp_pass'   => 'ssri2000+*27gOihJ',  // Password gmail
                'smtp_crypto' => 'ssl',
                'smtp_port'   => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];
            
            $this->load->library('email', $config);
            $this->email->from($param['from']['email'], $param['from']['name']);
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
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Master</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">

    <link rel="icon" href="<?= base_url('assets/img/favicon/favicon-16x16.png'); ?>" sizes="16x16">
    <link rel="icon" href="<?= base_url('assets/img/favicon/favicon-32x32.png'); ?>" sizes="32x32">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc.1/dist/chartjs-plugin-datalabels.min.js"></script>

    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script type="text/javascript">
        window.html2canvas = html2canvas;
        window.jsPDF = window.jspdf.jsPDF;

        function makePDF(){
            var doc = new jsPDF();
            html2canvas(document.querySelector("#capture"),{
                allowTaint:true,
                useCORS: true,
                scale: 4
            }).then(canvas => {               
                var img = canvas.toDataURL("image/jpeg");
                doc.addImage(img,'JPEG',5,7,200,45);
            });
            html2canvas(document.querySelector("#capture2"),{
                allowTaint:true,
                useCORS: true,
                scale: 4
            }).then(canvas => {               
                var img = canvas.toDataURL("image/jpeg");
                doc.addImage(img,'JPEG',5,52,200,80);
            });
            html2canvas(document.querySelector("#capture3"),{
                allowTaint:true,
                useCORS: true,
                scale: 4
            }).then(canvas => {               
                var img = canvas.toDataURL("image/jpeg");
                doc.addImage(img,'JPEG',5,133,200,82);
                doc.addPage();
            });
            html2canvas(document.querySelector("#capture4"),{
                allowTaint:true,
                useCORS: true,
                scale: 4
            }).then(canvas => {               
                var img = canvas.toDataURL("image/jpeg");
                doc.addImage(img,'JPEG',5,7,200,150);
                doc.addPage();
            });            
            html2canvas(document.querySelector("#capture5"),{
                allowTaint:true,
                useCORS: true,
                scale: 4
            }).then(canvas => {               
                var img = canvas.toDataURL("image/jpeg");
                doc.addImage(img,'JPEG',5,7,200,145);
                doc.addPage();
            });
            html2canvas(document.querySelector("#capture6"),{
                allowTaint:true,
                useCORS: true,
                scale: 4
            }).then(canvas => {               
                var img = canvas.toDataURL("image/jpeg");
                doc.addImage(img,'JPEG',5,7,200,190);
                doc.save('DEBITNOTE_REPORT.pdf');
            });
        }
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
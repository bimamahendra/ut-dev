<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEBIT NOTE</title>

    <style>
        html,
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .w-100 {
            width: 100%;
        }

        .w-50 {
            min-width: 50%;
            max-width: 50%;
        }

        .table-center {
            margin-right: auto;
            margin-left: auto;
        }

        .table-layout-fixed {
            table-layout: fixed;
        }

        .p-min {
            padding: .2em .2em;
        }

        .p-med {
            padding: .8em .3em;
        }

        .pl-min {
            padding-left: .5em;
        }

        .pt-min {
            padding-top: .5em;
        }

        .pb-min {
            padding-bottom: .5em;
        }

        .pb-max {
            padding-bottom: 3em;
        }

        .valign-middle {
            vertical-align: middle;
        }

        .valign-top {
            vertical-align: text-top;
        }

        .p-max {
            padding: 2em;
        }

        .mb-max {
            margin-bottom: 3rem;
        }

        .mb-min {
            margin-bottom: .5rem;
        }

        .mb-med {
            margin-bottom: 1.5rem;
        }

        .border-collapse {
            border-collapse: collapse;
        }

        .border-1 {
            border: 1px solid black;
        }

        .border-2 {
            border: 2px solid black;
        }

        .border-right {
            border-right: 1px solid black;
        }

        .border-left {
            border-left: 1px solid black;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        .border-top {
            border-top: 1px solid black;
        }

        .text-title {
            font-size: 24px;
        }

        .text-regular {
            font-size: 14px;
        }

        .text-regular-sm {
            font-size: 10px;
        }

        .text-regular-md {
            font-size: 18px;
        }

        .font-weight-regular {
            font-weight: 400;
        }

        .font-weight-bold {
            font-weight: 800;
        }

        .text-align-left {
            text-align: left;
        }

        .text-align-right {
            text-align: right;
        }

        .text-align-center {
            text-align: center;
        }

        .text-align-justify {
            text-align: justify;
        }

        .text-vertical {
            writing-mode: vertical-rl;
        }

        .watermark::before {
            position: absolute;
            top: 35%;
            left: 10%;
            content: "General Affairs Department";
            z-index: 99;
            font-size: 80px;
            transform: rotate(-30deg);
            color: rgba(0, 0, 0, .15);
            text-align: center;
            line-height: 1.8em;
        }

        .wrapper-page {
            page-break-after: always;
        }

        .wrapper-page:last-child {
            page-break-after: avoid;
        }

        .bg-grey {
            background-color: #C0C0C0;
        }

        .absolute {
            position: absolute;
        }

        .pos-right {
            right: 0;
        }
    </style>

</head>

<body>
    <div class="wrapper-page">
        <p class="text-align-center mb-med">
            <img src="<?= base_url('assets/img/logo.png'); ?>" alt="" width="70">
        </p>
        <table class="border-collapse w-100 valign-middle mb-med table-layout-fixed text-regular-sm">
            <tr>
                <td width="50%"><strong>PT UNITED TRACTORS Tbk</strong></td>
                <td width="50%" class="text-align-right text-regular-md valign-top" rowspan="3"><strong>NOTA DEBIT / DEBIT NOTE</strong></td>
            </tr>
            <tr>
                <td>Jalan Raya Bekasi Km. 22, Jakarta 13910 - Indonesia</td>
            </tr>
            <tr>
                <td>NPWP : 01.308.524.6-091.000</td>
            </tr>
        </table>
        <table class="border-collapse w-100 valign-middle mb-med table-layout-fixed text-regular-sm">
            <tr>
                <td width="50%">Kepada (Sold To) :</td>
                <td width="50%" class="text-align-justify text-regular-sm border-1" rowspan="4">
                    Nota Debit ini berlaku sebagai Faktur Pajak sesuai ketentuan dalam pasal 05 Peraturan Dirjen Pajak
                    Nomor 24/PJ/2012 tanggal 22 November 2012 dan S-6285/WPJ.19/KP.01/ 2011 tanggal 10 Agustus 2011
                    (This debit note acts as a tax debit note according to the terms under chapter 05 of the Tax Directorate
                    General Regula on No. 24/PJ/2012 dated on November 22nd 2012 and S-6285/WPJ.19/KP.01/2011
                    dated on August 10th 2011).
                </td>
            </tr>
            <tr>
                <td><strong>....................................(Nama PT)</strong></td>
            </tr>
            <tr>
                <td>.....................................(Alamat)</td>
            </tr>
            <tr>
                <td>
                    NPWP :
                    ...............................................
                </td>
            </tr>
        </table>
        <table class="border-collapse w-100 valign-middle mb-med table-layout-fixed text-regular-sm">
            <tr>
                <td width="30%">Nomor Pelanggan (Account No)</td>
                <td width="20%">: .............................</td>
                <td width="30%">Nomor Faktur (Debit Note)</td>
                <td width="20%">: .............................</td>
            </tr>
            <tr>
                <td>Nomor Pesanan (Order Reff)</td>
                <td>: -</td>
                <td>Tanggal Faktur (DN Date)</td>
                <td>: .............................</td>
            </tr>
            <tr>
                <td>Tanggal Pesanan (Order Due Date)</td>
                <td>: -</td>
                <td>Tanggal Jatuh Tempo (Payment Due Date)</td>
                <td>: .............................</td>
            </tr>
            <tr>
                <td>Mata Uang (Currency)</td>
                <td>: IDR</td>
                <td>Nomor Faktur Pajak (VAT No.)</td>
                <td>: .............................</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Kurs Pajak (Tax Currency)</td>
                <td>: .............................</td>
            </tr>
        </table>
        <table class="border-collapse w-100 valign-middle mb-med table-layout-fixed text-regular-sm">
            <tr>
                <td class="text-align-center border-top pt-min pb-min border-bottom" width="10%" rowspan="3">NO.</td>
                <td class="text-align-left border-top pt-min" width="60%">NAMA BARANG KENA PAJAK / JASA KENA PAJAK</td>
                <td class="text-align-center border-top pt-min" width="20%">HARGA JUAL/PENGGANTIAN</td>
                <td class="border-top" width="10%"></td>
            </tr>
            <tr>
                <td class="text-align-left">PENJELASAN</td>
                <td class="text-align-center">(AMOUNT)</td>
                <td></td>
            </tr>
            <tr>
                <td class="text-align-left border-bottom pb-min">(DESCRIPTION)</td>
                <td class="text-align-center border-bottom pb-min">Valas</td>
                <td class="text-align-center border-bottom pb-min">Rp.</td>
            </tr>
            <tr>
                <td class="text-align-center pb-max border-bottom p-med">1.</td>
                <td class="text-align-left pb-max border-bottom p-med">............................................<br></td>
                <td class="text-align-center pb-max border-bottom p-med">............................................</td>
                <td class="text-align-center pb-max border-bottom p-med"></td>
            </tr>
        </table>
        <table class="border-collapse w-100 mb-med table-layout-fixed text-regular-sm">
            <tr>
                <td width="50%" style="font-size: 8px;">
                    Ketentuan pembayaran : <br>
                    - Jumlah total harga termasuk PPN yang tercantum dalam faktur adalah berdasarkan pesanan <br>
                    - Pembayaran dengan menggunakan cek/giro harus mencantumkan nama PT United Tractors Tbk <br>
                    - Pembayaran dengan mengunakan transfer harus mencantumkan nomor dan nama pelanggan <br>
                    - Rincian nomor invoice yang dibayar harus dicantumkan <br>
                    - Pembayaran harga jual/penggantian dilakukan dalam original currency atau dalam Rupiah dengan menggunakan kurs <span style="color: red;">jual Bank Indonesia pada saat dana diterima.</span> <br>
                    - Pembayaran PPN dalam rupiah atau dalam original currancy dengan menggunakan kurs pajak sesuai tanggal faktur. <br>
                    - Pembayaran dengan transfer ditujukan ke <strong>PT UNITED TRACTORS Tbk : IDR ke BANK PERMATA Cabang : KELAPA GADING PERMAI Account : 0.200.330.02.1</strong> <br>
                    - Bagi Pelanggan yang mengiku Financing program ketentuan pembayaran mengiku ketentuan pembayaran dari bank.
                </td>
                <td width="50%" class="valign-top">
                    <table class="w-100 table-layout-fixed text-regular-sm pl-min">
                        <tr>
                            <td width="50%" class="pl-min text-align-right" style="font-size: 8px;"><strong>TOTAL HARGA JUAL/PENGGANTIAN</strong></td>
                            <td width="25%" class="text-align-center">-</td>
                            <td width="25%" class="text-align-center">-</td>
                        </tr>
                        <tr>
                            <td class="pl-min text-align-right" style="font-size: 8px;"><strong style="color: royalblue;">POTONGAN HARGA</strong></td>
                            <td class="text-align-center"></td>
                            <td class="text-align-center"></td>
                        </tr>
                        <tr>
                            <td class="pl-min text-align-right" style="font-size: 8px;"><strong>UANG MUKA (UM) YANG TELAH DITERIMA</strong></td>
                            <td class="text-align-center"></td>
                            <td class="text-align-center"></td>
                        </tr>
                        <tr>
                            <td class="pl-min text-align-right" style="font-size: 8px;"><strong style="color: royalblue;">HARGA SETELAH POTONGAN DAN UM/</strong></td>
                            <td class="text-align-center"></td>
                            <td class="text-align-center"></td>
                        </tr>
                        <tr>
                            <td class="pl-min text-align-right" style="font-size: 8px;"><strong style="color: royalblue;">DASAR PENGENAAN PAJAK</strong></td>
                            <td class="text-align-center">-</td>
                            <td class="text-align-center">0</td>
                        </tr>
                        <tr>
                            <td class="pl-min text-align-right" style="font-size: 8px;"><strong>PPN (VAT)</strong></td>
                            <td class="text-align-center">-</td>
                            <td class="text-align-center">-</td>
                        </tr>
                        <tr>
                            <td class="pl-min text-align-right" style="font-size: 8px;"><strong style="color: royalblue;">GRAND TOTAL</strong></td>
                            <td class="text-align-center">-</td>
                            <td class="text-align-center">0</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="border-collapse w-100 mb-med table-layout-fixed text-regular-sm">
            <tr>
                <td width="50%" class="valign-top">
                    <table class="border-collapse w-100 mb-med table-layout-fixed text-regular-sm border-1">
                        <tr>
                            <td width="33.33%">TARIF</td>
                            <td width="33.33%">DPP</td>
                            <td width="33.33%">PPn BM</td>
                        </tr>
                        <tr>
                            <td>...........%</td>
                            <td>Rp. ..........</td>
                            <td>Rp. .........</td>
                        </tr>
                    </table>
                    <table class="border-collapse w-100 mb-med table-layout-fixed" style="font-size: 8px;">
                        <tr>
                            <td width="20%">Lembar putih</td>
                            <td width="80%">: Untuk Pembeli BKP/Penerima JKP sebagai buk Pajak Masukan,</td>
                        </tr>
                        <tr>
                            <td>Lembar merah</td>
                            <td>: Untuk Penjual BKP/Pemberi JKP sebagai buk Pajak Keluaran,</td>
                        </tr>
                        <tr>
                            <td>Lembar kuning</td>
                            <td>: Salinan tambahan.</td>
                        </tr>
                    </table>
                </td>
                <td width="50%" class="text-align-right">
                    <table class="border-collapse w-100 mb-med table-layout-fixed text-regular-sm text-align-center">
                        <tr>
                            <td>
                                Jakarta, .............................. 2021
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="https://via.placeholder.com/75" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    Bagus Setiawan
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                General Affairs Department Head
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p class="text-align-center mb-med">
            <img src="<?= base_url('assets/img/logo.png'); ?>" alt="" width="70">
        </p>
    </div>
</body>

</html>
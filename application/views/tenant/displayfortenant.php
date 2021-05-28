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
            font-family: times new roman;
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
            font-size: 24px;
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

        .tg {
			border-style: solid;
			border-width: 2px;
			border-collapse: collapse;
			border-spacing: 0;
		}

        .tg .tg-5rbv {
			border: 1px solid black;
			padding-top: 4px;
			padding-bottom: 4px;
			font-size: 14px;
			border-color: black;
			font-weight: bold;
			text-align: center;
			vertical-align: middle
		}

        .tg .tg-5rba {
			border: 1px solid black;
			padding-top: 4px;
			padding-bottom: 4px;
			font-size: 14px;
			border-color: black;
			text-align: center;
			vertical-align: middle
		}

        .ch {
            background-color: darkblue;
            color: white;
        }
    </style>

</head>

<body>
<div class="wrapper-page">
    <table class="border-collapse w-100 valign-middle mb-med table-layout-fixed border-2">
    <tr>
    <td style="padding: 10px 30px 10px">
        <br>
        <table class="border-collapse w-100 valign-middle mb-med table-layout-fixed">
				<tr>
					<th>
						<img class="valign-middle" src="<?= base_url('assets/img/tenant/logo.png'); ?>" height="80px">
					</th>
                    <th width="55%">
                    </th>
					<th>
						<img class="valign-middle" src="<?= base_url('assets/img/tenant/logo.png'); ?>" height="80px">
					</th>
				</tr>
        </table>

    <div style="text-align:center;font-size:40px;">
		<strong>DEBIT NOTE MONITORING DISPLAY FOR <BR> TENANT</strong>
	</div>
    <br>
    <table class="border-collapse w-100 valign-middle mb-med table-layout-fixed text-regular-md">
            <tr>
                <td width="11%">PERUSAHAAN</td>
                <td width="80%">: ...</td>
            </tr>
            <tr>
                <td>STATUS</td>
                <td>: ...</td>
            </tr>
    </table>
    <table class="tg" width="100%" style="border-color: black;">
        <tr>
            <td class="tg-5rbv ch">Tipe DN</td>
            <td class="tg-5rbv ch">Tahun DN</td>
            <td class="tg-5rbv ch">No. DN</td>
            <td class="tg-5rbv ch">Tanggal Faktur</td>
            <td class="tg-5rbv ch">Tanggal Jatuh Tempo</td>
            <td class="tg-5rbv ch">AR <br> Aging</td>
            <td class="tg-5rbv ch">Kategori AR <br> Aging</td>
            <td class="tg-5rbv ch">No. Faktur Pajak</td>
            <td class="tg-5rbv ch">Tanggal DN</td>
            <td class="tg-5rbv ch">Mata <br> Uang</td>
            <td class="tg-5rbv ch">Nama Perusahaan</td>
            <td class="tg-5rbv ch">Barang/Jasa Kena Pajak</td>
            <td class="tg-5rbv ch">Grand Total</td>
        </tr>
        <tr>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
            <td class="tg-5rba">...</td>
        </tr>
    </table>
    <br>
    <br>
    <p style="font-size:20px;">Shall you have any question or further information, please contact us at +62 21 24579999 ext. 16053 or by email to <br> <u>admgeneralaffairs@unitedtractors.com</u>.</p>
    <p style="font-size:20px;">Thank you for your kind attention and cooperation.</p>
    <p style="font-size:20px;">Sincerely,</p>
    <p style="font-size:24px;"><strong>PT United Tractors Tbk</strong></p>
    </td>
    </tr>
    <table>
</div>
</body>
</html>
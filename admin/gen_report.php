<?php

include '../vendor/autoload.php';

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
	header("Location: login.php");
	exit();
}

include_once "config.php";

if (isset($_POST['submit'])) {
	$date1 = $_POST['from-date'];
	$date2 = $_POST['to-date'];
}

$TodayDate = mktime(date("m"), date("d"), date("Y"));
$Date = date("Y-m-d", $TodayDate);

$sql1 = mysqli_query($conn, "SELECT * FROM orders WHERE placed_on between '$date1' AND '$date2' ");

$html = '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Download Invoice</title>

	<style>
		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
			font-size: 16px;
			line-height: 24px;
			font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		.information {
			text-align: center;
		}

		.invoice-box .logo {
			text-align: center;
		}

		.invoice-box .logo img {
			width: 90%;
			max-width: 160px;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}

		/** RTL **/
		.invoice-box.rtl {
			direction: rtl;
			font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		}

		.invoice-box.rtl table {
			text-align: right;
		}

		.invoice-box.rtl table tr td:nth-child(2) {
			text-align: left;
		}
	</style>
</head>

<body>
<div class="invoice-box">
	<table cellpadding="0" cellspacing="0">
		<tr class="top">
			<td colspan="6">
				<table>
					<tr>
						


						<td style="width:40% text-align:right;" >
							Created Report : '.$Date.'<br>
							From : '.$date1.'<br>
							To   : '.$date2.'
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr class="information" style="text-align: center; font-size: 14px; font-weight: bold;">
			<td colspan="6">
				<table>
					<tr class="item">
						<td colspan="6" style="text-align:center; width: 30%;">
							<strong>Wewin Event</strong><br />
							<strong>wewinevent@gmail.com</strong>
						</td>
					</tr>
				</table>
			</td>
		</tr>';

		$html .= '<tr class="item">
					<td style="width: 6%; font-weight: bold;"> ID </td>
					<td style="width: 30%; text-align:left; font-weight: bold;">Theme Name</td>
					<td style="width: 20%; text-align:left; font-weight: bold;">Token No.</td>
					<td style="width: 20%; text-align:center; font-weight: bold;">Booking Date</td>
					<td style="width: 20%; text-align:center; font-weight: bold;">Event Date</td>
					<td style="width: 20%; text-align:center; font-weight: bold;">Payment Status</td>
					<td style="width: 10%;text-align:right; font-weight: bold;">Total Amount</td>';

$total_price = 0;
if (mysqli_num_rows($sql1) > 0) {
	while ($list = mysqli_fetch_assoc($sql1)) {
		$orderDate = date("m/d/Y", strtotime($list["order_date"]));
		$html .= '<tr class="item">
					<td style="width: 6%;" >' . $list['id'] . '</td>
					<td style="width: 30%; text-align:left;">' . $list['item_names'] . '</td>
					<td style="width: 30%; text-align:left;">' . $list['token_no'] . '</td>
					<td style="width: 20%; text-align:center;">' . $list['placed_on'] . '</td>
					<td style="width: 20%; text-align:center;">' . $orderDate . '</td>
					<td style="width: 20%; text-align:center;">' . $list['payment_status'] . '</td>
					<td style="width: 10%;text-align:right;">₹' . $list['total_amount'] . '</td>';
		$total_price += $list['total_amount'];
		'</tr>';
	}
} else {
	$html .= '<tr class="item">
					<td colspan="6" style="text-align:center;">No Record Found!, Please Select other dates</td>
				</tr>';
}

$html .= '<tr class="total">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="text-align:right; width: 20%;"><b>Total:₹' . $total_price . '</b> </td>
			</tr>';

$html .= '</table>
	</div>
</body>
</html>';

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);
$mpdf->Output();
// <td class="logo">
						// 	<img src="../php/img/logo.png" style="width: 200px; height: 100px;" />
						// </td>
?>
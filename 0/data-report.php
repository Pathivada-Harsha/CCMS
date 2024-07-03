<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';
SessionManager::checkSession();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
	<title>Data report</title> 
	<?php
	include(BASE_PATH."assets/html/start-page.php");
	?>
	<div class="d-flex flex-column flex-shrink-0 p-3 main-content ">
		<div class="container-fluid">
			<div class="row d-flex align-items-center">
				<div class="col-12 p-0">
					<p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Data report</span></p>
				</div>
			</div>
			<?php
			include(BASE_PATH."dropdown-selection/group-device-list.php");
			?>
			<div class="row">
				
				<div class="col-12 p-0">
					<div class="table-responsive rounded mt-2 border">
						<table class="table table-striped table-bordered table-hover table-type-1 table-sticky-header w-100">
							<thead class="sticky-header text-center">
								<tr class="header-row-1">
									<th class="bg-primary text-white"></th>
									<th class="bg-primary text-white col-size-1" >Updated at</th>
									<th class="bg-primary text-white">ON/OFF Status</th>
									<th class="bg-primary text-white" colspan="3">Phase Voltages (Volts)</th>
									<th class="bg-primary text-white" colspan="3">Phase Currents (Amps)</th>
									<th class="bg-primary text-white" colspan="4">KW</th>
									<th class="bg-primary text-white" colspan="4">KVA</th>

									<th class="bg-primary text-white" colspan="2">Energy (Units)</th>
									<th class="bg-primary text-white" colspan="3">Power Factor</th>
									<th class="bg-primary text-white" colspan="3">Frequency (Hz)</th>
									<th class="bg-primary text-white">Signal Level</th>
									<th class="bg-primary text-white">Location</th>
								</tr>
								<tr class="header-row-2">

									<th class="bg-secondary text-white">Device Id</th>
									<th class="bg-secondary text-white col-size-1"></th>
									<th class="bg-secondary text-white"></th>
									<th class="bg-secondary text-white">R</th>
									<th class="bg-secondary text-white">Y</th>
									<th class="bg-secondary text-white">B</th>

									<th class="bg-secondary text-white">R</th>
									<th class="bg-secondary text-white">Y</th>
									<th class="bg-secondary text-white">B</th>

									<th class="bg-secondary text-white">R</th>
									<th class="bg-secondary text-white">Y</th>
									<th class="bg-secondary text-white">B</th>
									<th class="bg-secondary text-white">Total</th>

									<th class="bg-secondary text-white">R</th>
									<th class="bg-secondary text-white">Y</th>
									<th class="bg-secondary text-white">B</th>
									<th class="bg-secondary text-white">Total</th>

									<th class="bg-secondary text-white">kWh</th>
									<th class="bg-secondary text-white">kVAh</th>
									<th class="bg-secondary text-white">R</th>
									<th class="bg-secondary text-white">Y</th>
									<th class="bg-secondary text-white">B</th>
									<th class="bg-secondary text-white">R</th>
									<th class="bg-secondary text-white">Y</th>
									<th class="bg-secondary text-white">B</th>
									<th class="bg-secondary text-white"></th>
									<th class="bg-secondary text-white"></th>

								</tr>
							</thead>
							<tbody class="text-center">	
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:50:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >3621/16 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:49:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/17 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:48:10 21-05-2044</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/14 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:47:10 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/14 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:46:10 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/12 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:45:10 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3615/12 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:44:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/12 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:43:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/18 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:42:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3615/12 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:41:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3615/11 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:40:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/19 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:39:09 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/18 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:38:08 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/17 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:37:07 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/17 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:36:07 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3621/17 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:35:07 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3615/17 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:34:06 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3615/17 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:33:06 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3615/16 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:32:08 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>

									<td >3615/16 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
								<tr>
									<td >CCMS_7</td>
									<td class="col-size-1" >11:31:07 21-05-2024</td>
									<td >OFF</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >657.93</td>
									<td >0.02</td>
									<td >1</td>
									<td >1</td>
									<td >1</td>
									<td >0</td>
									<td >0</td>
									<td >0</td>
									<td >3615/16 </td>
									<td ><a href="#" onclick="get_location(&quot;1729.5477,07825.7630&quot;)" style="color:#0066FF;">Track Location</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>
<?php
include(BASE_PATH."assets/html/body-end.php");
include(BASE_PATH."assets/html/html-end.php");
?>
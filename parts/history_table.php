<script>
	function goToPage(Page){
		if(Page == "1"){
			document.getElementById("field_1_1").innerHTML = '0020';
			document.getElementById("field_1_2").innerHTML = 'Client 20';
			document.getElementById("field_1_3").innerHTML = '20-01-2013';
			document.getElementById("field_1_4").innerHTML = 'Wong Tai Sin';
			
			document.getElementById("field_2_1").innerHTML = '0019';
			document.getElementById("field_2_2").innerHTML = 'Client 19';
			document.getElementById("field_2_3").innerHTML = '19-01-2013';
			document.getElementById("field_2_4").innerHTML = 'Sha Tin';
			
			document.getElementById("field_3_1").innerHTML = '0018';
			document.getElementById("field_3_2").innerHTML = 'Client 18';
			document.getElementById("field_3_3").innerHTML = '18-01-2013';
			document.getElementById("field_3_4").innerHTML = 'Tai Po';
			
			document.getElementById("field_4_1").innerHTML = '0017';
			document.getElementById("field_4_2").innerHTML = 'Client 17';
			document.getElementById("field_4_3").innerHTML = '17-01-2013';
			document.getElementById("field_4_4").innerHTML = 'Tai Po';
			
			document.getElementById("field_5_1").innerHTML = '0016';
			document.getElementById("field_5_2").innerHTML = 'Client 16';
			document.getElementById("field_5_3").innerHTML = '16-01-2013';
			document.getElementById("field_5_4").innerHTML = 'Mei Foo';
		}else if(Page == "2"){
			document.getElementById("field_1_1").innerHTML = '0015';
			document.getElementById("field_1_2").innerHTML = 'Client 15';
			document.getElementById("field_1_3").innerHTML = '15-01-2013';
			document.getElementById("field_1_4").innerHTML = 'Mong Kok';
			
			document.getElementById("field_2_1").innerHTML = '0014';
			document.getElementById("field_2_2").innerHTML = 'Client 14';
			document.getElementById("field_2_3").innerHTML = '14-01-2013';
			document.getElementById("field_2_4").innerHTML = 'Wong Tai Sin';
			
			document.getElementById("field_3_1").innerHTML = '0013';
			document.getElementById("field_3_2").innerHTML = 'Client 13';
			document.getElementById("field_3_3").innerHTML = '13-01-2013';
			document.getElementById("field_3_4").innerHTML = 'Wong Tai Sin';
			
			document.getElementById("field_4_1").innerHTML = '0012';
			document.getElementById("field_4_2").innerHTML = 'Client 12';
			document.getElementById("field_4_3").innerHTML = '12-01-2013';
			document.getElementById("field_4_4").innerHTML = 'Sai Kung';
			
			document.getElementById("field_5_1").innerHTML = '0011';
			document.getElementById("field_5_2").innerHTML = 'Client 11';
			document.getElementById("field_5_3").innerHTML = '11-01-2013';
			document.getElementById("field_5_4").innerHTML = 'Hung Ham';
		}else if(Page == "3"){
			document.getElementById("field_1_1").innerHTML = '0010';
			document.getElementById("field_1_2").innerHTML = 'Client 10';
			document.getElementById("field_1_3").innerHTML = '10-01-2013';
			document.getElementById("field_1_4").innerHTML = 'Mong Kok';
			
			document.getElementById("field_2_1").innerHTML = '0009';
			document.getElementById("field_2_2").innerHTML = 'Client 09';
			document.getElementById("field_2_3").innerHTML = '09-01-2013';
			document.getElementById("field_2_4").innerHTML = 'Mong Kok';
			
			document.getElementById("field_3_1").innerHTML = '0008';
			document.getElementById("field_3_2").innerHTML = 'Client 08';
			document.getElementById("field_3_3").innerHTML = '08-01-2013';
			document.getElementById("field_3_4").innerHTML = 'Lai Chi Kok';
			
			document.getElementById("field_4_1").innerHTML = '0007';
			document.getElementById("field_4_2").innerHTML = 'Client 07';
			document.getElementById("field_4_3").innerHTML = '07-01-2013';
			document.getElementById("field_4_4").innerHTML = 'Tai Wai';
			
			document.getElementById("field_5_1").innerHTML = '0006';
			document.getElementById("field_5_2").innerHTML = 'Client 06';
			document.getElementById("field_5_3").innerHTML = '06-01-2013';
			document.getElementById("field_5_4").innerHTML = 'Central';
		}else if(Page == "4"){
			document.getElementById("field_1_1").innerHTML = '0005';
			document.getElementById("field_1_2").innerHTML = 'Client 05';
			document.getElementById("field_1_3").innerHTML = '05-01-2013';
			document.getElementById("field_1_4").innerHTML = 'Central';
			
			document.getElementById("field_2_1").innerHTML = '0004';
			document.getElementById("field_2_2").innerHTML = 'Client 04';
			document.getElementById("field_2_3").innerHTML = '04-01-2013';
			document.getElementById("field_2_4").innerHTML = 'Lai Chi Kok';
			
			document.getElementById("field_3_1").innerHTML = '0003';
			document.getElementById("field_3_2").innerHTML = 'Client 03';
			document.getElementById("field_3_3").innerHTML = '03-01-2013';
			document.getElementById("field_3_4").innerHTML = 'Wong Tai Sin';
			
			document.getElementById("field_4_1").innerHTML = '0002';
			document.getElementById("field_4_2").innerHTML = 'Client 02';
			document.getElementById("field_4_3").innerHTML = '02-01-2013';
			document.getElementById("field_4_4").innerHTML = 'Sha Tin';
			
			document.getElementById("field_5_1").innerHTML = '0001';
			document.getElementById("field_5_2").innerHTML = 'Client 06';
			document.getElementById("field_5_3").innerHTML = '01-01-2013';
			document.getElementById("field_5_4").innerHTML = 'Wong Tai Sin';
		}else if(Page == "more"){
			document.getElementById("page4").innerHTML = '4';
		}
	}
	
</script>

<table border=1px >
	<tr>
		<th>Job ID</th>
		<th>Client</th>
		<th>Date</th>
		<th>Location</th>
	</tr>
	<tr>
		<td><div id="field_1_1">0020</div></td>
		<td><div id="field_1_2">Client 20</div></td>
		<td><div id="field_1_3">20-01-2013</div></td>
		<td><div id="field_1_4">Wong Tai Sin</div></td>
	</tr>
	<tr>
		<td><div id="field_2_1">0019</div></td>
		<td><div id="field_2_2">Client 19</div></td>
		<td><div id="field_2_3">19-01-2013</div></td>
		<td><div id="field_2_4">Sha Tin</div></td>
	</tr>
	<tr>
		<td><div id="field_3_1">0018</div></td>
		<td><div id="field_3_2">Client 18</div></td>
		<td><div id="field_3_3">18-01-2013</div></td>
		<td><div id="field_3_4">Tai Po</div></td>
	</tr>
	<tr>
		<td><div id="field_4_1">0017</div></td>
		<td><div id="field_4_2">Client 17</div></td>
		<td><div id="field_4_3">17-01-2013</div></td>
		<td><div id="field_4_4">Tai Po</div></td>
	</tr>
	<tr>
		<td><div id="field_5_1">0016</div></td>
		<td><div id="field_5_2">Client 16</div></td>
		<td><div id="field_5_3">16-01-2013</div></td>
		<td><div id="field_5_4">Mei Foo</div></td>
	</tr>
	<tr>
		<td colspan="4" style="text-align: center">
			<a href="javascript:goToPage('1')"><div style="display: inline" id="page1">1</div></a>
			<a href="javascript:goToPage('2')"><div style="display: inline" id="page2">2</div></a>
			<a href="javascript:goToPage('3')"><div style="display: inline" id="page3">3</div></a>
			<a href="javascript:goToPage('4')"><div style="display: inline" id="page4"></div></a>
			<a href="javascript:goToPage('more')"><div id="more" style="display: inline">More</div></a> 
		</td>
	</tr>
</table>
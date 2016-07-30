<?php  
 $connect = mysqli_connect("localhost", "root", "", "305cde");  
 $sql = "SELECT * FROM newpost ORDER BY id DESC";  
 $result = mysqli_query($connect, $sql);  
 
 if(mysqli_num_rows($result) > 0)  
	{  
		while($row = mysqli_fetch_array($result))  
		{  
		// Fetch data from selected table and output to html
			$output .= '  
			<table width="100%">
				<tbody>
					<tr>
						<td style="width:96%"><h3>'.$row["subject"].'</h3><span class="msg-desp">'.$row["date"].'</span></td>
					</tr>
					<tr>
						<td>
						<span class="msg-user">'.$row["username"].'</span><span class="msg-desp">'.$row["email"].'</span>
						<p class="msg-line">'.$row["message"].'</p>
						</td>
					</tr>
				</tbody>
			</table>
			';  
		}  
	}  
	else  
	{  
	$output .= 'Data not Found';  
	}  


 echo $output;  
 ?>  
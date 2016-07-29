<?php  
 $connect = mysqli_connect("localhost", "simpiratio_305", "Lo24768", "simpiratio_305");  
 $sql = "SELECT * FROM newpost ORDER BY id DESC";  
 $result = mysqli_query($connect, $sql);  
 if(mysqli_num_rows($result) > 0)  
	{  
		while($row = mysqli_fetch_array($result))  
		{  
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
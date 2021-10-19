<!DOCTYPE html>
<html>
<head>
	<title>Larave Test Task</title>
</head>
<body>
   
<center>
<h2 style="padding: 23px;border-bottom: 6px green solid;">
	<a href="#">Laravel Tast</a>
</h2>
</center>
  
<p>Hello!</p>
<h5>{{$title}}</h5>
<p>{{$description}}</p>
<p>Posted Date : {{date("Y-M-d",strtotime($created_at))}} At {{date("h:i S",strtotime($created_at))}}</p>
<strong>Regards,Test Tast</strong>

</body>
</html>
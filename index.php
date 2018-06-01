<?php

  /*
    Get Group Member's ID Facebook 
	Coded with all the love by Junior
	©2018 - SE Community
  */
  
  error_reporting(0);
  if(isset($_GET['id'])){
	  $access_token = ""; // Nhập Access Token 
	  $limit = ""; // Số lượng ID cần lấy
	  $decode = json_decode(request("https://graph.fb.me/".$_GET['id']."/members?fields=id&limit=$limit&access_token=$access_token"),1);
	  if(!$decode['data']){
		  echo "ID Group không tồn tại hoặc sai Access Token";
	  }
	  else{
		  for($i=0;$i<count($decode['data']);$i++){
			  $datas = $decode['data'];
			  $file = fopen('list.txt','a');
			  fwrite($file,$datas[$i]['id']."\n");
			  if($i == count($datas[$i]['id'])){
				  echo "Lấy ID thành công !!! \n";
				  echo "Xem ID đã lấy : <a href='list.txt'>Click</a>";
			  }
		  }
	  }
  }
  else{
	  $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	  echo "Bạn phải nhập ID Group vào URL. VD: $url?id=3183918291...";
  }
  
  function request($url){
	$ch = curl_init();
	CURL_SETOPT_ARRAY($ch,array(
		CURLOPT_URL => $url,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36"
	));
	$response = curl_exec($ch);
	return $response;
	curl_close($ch);
}
?>

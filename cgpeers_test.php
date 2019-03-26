<?php 
/**
     * 模拟post进行url请求
     * @param string $url
     * @param array $post_data
     */
    function request_post($url = '',$ispost=true, $post_data = array()) 
	{
        if (empty($url) || empty($post_data)) {
            return false;
        }
        
        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);
        $key=md5(base64_encode($post_data));
        if($ispost){
            $url=$url;
        }else{
            $url = $url.'?'.$post_data;
        }
        
       
        $curlPost = 'key='.$key;
        header("Content-type: text/html; charset=utf-8");
		echo $post_data."\n";
		$url = "https://www.cgpeers.com/torrents.php?action=download&id=60490&authkey=9e288a647f08226f05620f5e16f233e1&torrent_pass=d04jtipgbnive3g1dk525rtp5granc0s";
		echo $url;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查  
    	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
		$UserAgent = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0"; // 模拟浏览器类型
		curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        if($ispost){
            curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        }
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
		echo $data;
		file_put_contents('test.torrent',$data);
		echo "lalala";
        return $data;
    }

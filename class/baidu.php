<?php
// baidu music collect class 
class musicBaidu
{
	function musicBaidu(){}
	
	function getConfig($conf){
		if ( $conf == 100 ) {
			$config = $this->getTop100();
		} elseif ( $conf == 500 ) {
			$config = $this->getTop500();
		}
		return $config ;
	}
	
	function getTop500()
	{
		$config['number'] = 500;
		$config['http']   = 'http://list.mp3.baidu.com/topso/mp3topsong.html#top2';
		return $config ;
	}
	
	function getTop100()
	{
		$config['number'] = 100;
		$config['http']   = 'http://list.mp3.baidu.com/topso/mp3topsong.html#top1';		
		return $config ;
	}
	
	function getSearchUrl()
	{
		$url = "http://mp3.baidu.com/m?f=ms&tn=baidump3&ct=134217728&lf=&rn=&word={word}&lm=0";
		return $url ;
	}
	
	function getList($conf=100, $current=0, $limit=20)
	{
		$config = $this->getConfig($conf, $_REQUEST['start']);
		
		$musicList = $this->getMusicList();
		
		if ( !$musicList ) {
			$url    = $config['http'];
			$number = $config['number'];
			
			$a = implode('', file($url));
			$b = explode('class="border"><a href="', $a);
			set_time_limit(0);
			$i=0;
			while( $i < $number )
			{
				$tourl  = explode('" target=_blank>', $b[$i]);
				$geming = explode('</a>', $tourl[1]);
				$mp3url = $tourl[0];
				
				$musicurl[$i]['name'] = $this->getName($geming[0]);
				$musicurl[$i]['url']  = $this->getUrl($mp3url);
				
				$i++;
			}
			$this->cacheMusicList($musicurl);
		} else {
			$musicurl = $musicList ;
		}
		
		$total = count($musicurl);

		$re['page'] = $this->getPageNav($total, $current, $limit);
		print_r($re['page']) ;
		for ( $i=$current ; $i < ($current+$limit) ; $i++) {
			if ( $musicurl[$i] ) {
				$re['music'][] = $musicurl[$i] ;
			}
		}
		
		return $re ;
	}
	
	function getUrl($url)
	{
		$url .='&lm=0';
		$a    = implode('', file($url));
		
		$b    = explode('<td><a href="', $a);
		@$c   = explode('" onclick="', $b[2]);
		$d    = explode("baidumt,", $c[0]);
		$e    = explode("&word", $d[1]);
		
		$str  = $d[0] . "baidumt," . urlencode($e[0]) . "&word" . $e[1];
		$k    = file($str);
		$i    = explode('<a id="song_url" href="', trim($k['136']));
		$j    = explode('">', $i[1]);
		return $j[0];
	}
	
	function getName($name)
	{
		$pattern = "/<b>(.*)<\/b>/";
		if ( preg_match('<b>', $name) ) {
			preg_match($pattern, $name, $matches);
			$re = $matches[1];
		} else {
			$re = $name ;
		}
		
		$re = $this->gb2utf8($re);
		return $re ;
	}
	
	function gb2utf8($str)
	{
		$re = iconv('GB2312', 'UTF-8', $str);
		return $re;
	}
	
	function getPageNav($total, $start, $limit=20)
	{
		if ( $total > $limit ) {
			$preNum = $start - $limit ;
			if ( $preNum >= 0) {
				$pre  = '<span class="musiclistnav" start="' . $preNum . '"><img src="'.XOOPS_URL.'/modules/ncplayer/images/pre.gif"></span>' ;
			}
			
			$nextNum = $start + $limit ;
			if ( $nextNum < $total ) {
				$next = '<span class="musiclistnav" start="' . $nextNum . '"><img src="'.XOOPS_URL.'/modules/ncplayer/images/next.gif"></span>' ;
			}
		}		
		
		return "<span>" . $pre . " " . $next . "</span>";
	}
	
	function cacheMusicList($list){
		$filePath = XOOPS_UPLOAD_PATH . '/baidu_list.php';
		$fp = fopen($filePath, 'w+');
		$str .= '<?php ';
		$str .= ' return array(';
		foreach( $list as $k=>$v ) {
			$strt[]= " array( 'name' => '" . $v['name'] . "', 'url' => '" . $v['url'] ."')";
		}
		$str .= implode(',', $strt);
		$str .= ');';
		$str .= ' ?>';
		
		fwrite($fp, $str, strlen($str));
		fclose($fp);
	}
	
	function getMusicList()
	{
		$list = array();
		if ( $list = include_once XOOPS_UPLOAD_PATH . '/baidu_list.php' ) ;
		return $list ;
	}
	
	function search($word)
	{
		$music = array();
		$url = $this->getSearchUrl();
		$url = str_replace("{word}", urlencode($word), $url);
		if ( $murl =  $this->getUrl($url) ) {
			$music['url']  = $murl;
			$music['name'] = $word;
		} 
		return $music ;
	}
	
	
}



?>
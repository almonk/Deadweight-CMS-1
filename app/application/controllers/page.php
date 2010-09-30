<?php

class Page extends Controller {

	function Page()
	{
		parent::Controller();
		$this->load->helper('directory');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('typography');
		$this->load->library('parser');
		$this->load->helper('markdown');
		// $this->load->helper('yayparser');
	}

	function view()
	{			
		$title = $this->uri->segment(2, 0);
		$path = "content/";
		$nav = '';
		$map = directory_map($path,true);
		$map_count = count($map);
		$true_folder_name = '';
		
		if ($title) {
			for ($i=1; $i < $map_count; $i++) { 
				if (is_dir($path.$i.'.'.$title)==true) {
					$true_folder_name = $i.'.'.$title;
					break;
				}
			}
			if ($true_folder_name == '') {
				//if nothing was found we can throw a 404
				show_404('page');
				break;
			}
			$content = markdown(read_file($path.$true_folder_name.'/content.txt'));
			$is_index = false;
		}else{
			$title = 'home';
			$is_index = true;
			$true_folder_name = 'home';
			$content = markdown(read_file($path.$true_folder_name.'/content.txt'));
		}
		
		foreach ($map as $page) {
			if ($page !='home') {
				$folder_name = explode(".",$page);
				$folder_name = str_replace("-"," ",$folder_name);
				$pseduo_page_link = explode(".",$page);
				
				if ($pseduo_page_link[1] == urldecode($title)) {
					$nav.='<li class="current"><a href="'.base_url().'page/'.urlencode($pseduo_page_link[1]).'">'.ucwords($folder_name[1]).'</a></li>';
				}else{
					$nav.='<li><a href="'.base_url().'page/'.urlencode($pseduo_page_link[1]).'">'.ucwords($folder_name[1]).'</a></li>';
				}
			}
		}

		$files = directory_map($path.$true_folder_name,true);
		
		$images = array();

		foreach ($files as $media) {
			if ( substr($media,-3) == 'jpg' || substr($media,-3) == 'gif' || substr($media,-3) == 'png') {
				$images[] = base_url().$path.$true_folder_name.'/'.$media;
			}
		}
		
		$pages = array();//To be used to display info on all pages
		$i = 0;
		foreach ($map as $page) {
			if ($page !='home') {
				$pages_images = array();
				$page_title =
				$folder_name = explode(".",$page);
				$folder_name = str_replace("-"," ",$folder_name);
				$pseduo_page_link = explode(".",$page);
			
				$files = directory_map($path.$page,true);

				foreach ($files as $media) {
					if ( substr($media,-3) == 'jpg' || substr($media,-3) == 'gif' || substr($media,-3) == 'png') {
						$pages_images[] = base_url().$path.$true_folder_name.'/'.$media;
					}
				}
				
				if ($pseduo_page_link[1] == urldecode($title)) {
					$is_current = true;
				}else{
					$is_current = false;
				}
			
				$pages[$i] = array(
								'title' => str_replace("-"," ",ucfirst($pseduo_page_link[1])),
								'url' => base_url().'page/'.$pseduo_page_link[1],
								// 'content' => markdown(read_file($path.$page.'/content.txt')),
								'is_current' => $is_current,
								'images' => $pages_images
				);
				$i++;
			}
		}		
		
		
		if ($is_index == false){
			//Build the page title out of the title segment
			$title = str_replace("-"," ",$title);
			$title = ucfirst($title);
		}
			
		$data = array(
			'nav' => $nav,
			'title' => urldecode($title),
			'site_url' => base_url(),
			'is_index' => $is_index,
			'content' => $content,
			'jquery' => '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>',
			'jqueryui' => '<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js" type="text/javascript"></script>',
			'path' => base_url().$path.urldecode($title),
			'pages' => $pages,
			'media' => $files,
			'images' => $images
		);

		if ($is_index == true) {
			//If this is the homepage render the index.tpl file
			$this->parser->parse('../../../views/index.tpl', $data);
		}else{
			$this->parser->parse('../../../views/page.tpl', $data);
		}
	}
}